const fs = require( "fs" );
const cp = require( "child_process" );

const httpd = '-d . -f setup/httpd.conf -DFOREGROUND';
const mysqld = '--pid-file=mysqld.pid --skip-networking --skip-grant-tables --log-error-verbosity=0 --max_allowed_packet=512M -h ./setup/mysql_data' +
    ' --sql-mode=STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

const env = process.argv[2] == 'deploy' ? {} : require( 'ini' ).parse( cp.execSync( 'source setup/env && export' ).toString().replace( /export /g, '' ) );
Object.keys( env ).forEach( function( key ) { process.env[key] = env[key]; } );

eval( process.argv[2] )();

function spawn( cmd, args, detached ) {
    cp.spawn( cmd, args.split( ' ' ), {
        stdio: 'inherit',
        detached: detached === true
    } );
}

function db() {
    const mysql_initialized = fs.existsSync( 'setup/mysql_data' );
    const mysql_running = fs.existsSync( process.env.MYSQL_UNIX_PORT );

    if( !mysql_initialized ) cp.execSync( 'mysqld --skip-networking --initialize -h ./setup/mysql_data' );
    if( !mysql_initialized || !mysql_running ) spawn( 'mysqld', mysqld );

    let retries = 50;
    do {
        try {
            cp.execSync( 'echo "DROP DATABASE IF EXISTS localdb; CREATE DATABASE localdb" | mysql' );
            break;
        } catch(e) {
            retries--;
        }
    } while( retries );
    if( !retries ) throw new Error( 'mysqld not started' );

    cp.execSync( 'mysql localdb < database.sql' );

    if( !mysql_initialized || !mysql_running ) cp.execSync( 'kill `cat setup/mysql_data/mysqld.pid` || true' );
}

function start() {
    process.on( 'SIGINT', function() {
        cp.execSync( 'killall httpd || true' );
        cp.execSync( 'kill `cat setup/mysql_data/mysqld.pid` || true' );
        process.exit();
    } ); // catch ctrl-c

    process.on( 'SIGINFO', function() {
        db();
    } ); // catch ctrl-t

    cp.execSync( 'killall httpd 2> /dev/null || true' );
    cp.execSync( 'sleep 1' );

    spawn( 'httpd', httpd, true );
    if( !fs.existsSync( 'setup/mysql_data/mysqld.pid' ) ) spawn( 'mysqld', mysqld );

    if( cp.execSync( 'sleep 1 && curl -O /dev/null -s -k https://localhost || echo true' ).toString().trim() == 'true' ) {
        cp.execSync( 'echo "rdr pass inet6 proto tcp from ::1 to ::1 port 443 -> ::1 port 8443\nrdr pass inet proto tcp from 127.0.0.1 to 127.0.0.1 port 443 -> 127.0.0.1 port 8443" | sudo pfctl -ef - || true' );
    }
}

function reset() {
    cp.execSync( 'killall -9 httpd; rm setup/httpd.pid; killall -9 mysqld; rm -fR setup/mysql_data; rm -f /tmp/mysql-*' );
    db();
}
