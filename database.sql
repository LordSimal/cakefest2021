CREATE TABLE coins (
    `id` int(11) PRIMARY KEY AUTO_INCREMENT,
    `ext_ident` varchar(255) NOT NULL,
    `name` varchar(255) NOT NULL,
    `symbol` varchar(255) NOT NULL,
    `rank` int(11) unsigned NOT NULL,
    `price` float NOT NULL,
    `volume` float NOT NULL,
    `marketCap` bigint NOT NULL,
    `availableSupply` bigint NOT NULL,
    `totalSupply` bigint NOT NULL,
    `priceChange1h` float NOT NULL,
    `priceChange1d` float NOT NULL,
    `priceChange1w` float NOT NULL,
    `websiteUrl` varchar(255) NOT NULL,
    `created` datetime DEFAULT CURRENT_TIMESTAMP(),
    `modified` datetime DEFAULT CURRENT_TIMESTAMP()
)
