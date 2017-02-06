<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

/** Enable W3 Total Cache Edge Mode */
define('W3TC_EDGE_MODE', true); // Added by W3 Total Cache
define('WP_MEMORY_LIMIT', '512M');


/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'localpar_wp');

define('CONCATENATE_SCRIPTS', false);

/** MySQL database username */
define('DB_USER', 'localpar_vadim');

/** MySQL database password */
define('DB_PASSWORD', 'pronto120580');

/** MySQL hostname */
define('DB_HOST', '10.169.0.62');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'F+9BSWW6j]al_|)w5HN4Kuz$(O%m(V7XU%=t=7e|Lt20&Ux$ipzVKtY{&aM}D}B*');
define('SECURE_AUTH_KEY',  'FR2by.XWImrm4[;f~#!5bB}2B-0?%x#0+V6J{dN6RveCCe|{7@:?pm;{^ryx{i}x');
define('LOGGED_IN_KEY',    '*fs^e8bcYjtZ21s<<Mh.(o G:`z]}AN+YL_l {TymmVZD)ALjJF`(30]oNPY6~!3');
define('NONCE_KEY',        'VoS{|^FD[ERtSBqvyGaWOi(gfD)?4mJqf!ok)|z=ta0cI&|34,c[+)Pp^uPJu8nY');
define('AUTH_SALT',        'cS)7v5L0HPhbZ fFZAeCgg``)BVuUn+2doL(&4,@S*Sf6Pz#y=bj)<}C;!lcLqfT');
define('SECURE_AUTH_SALT', 'WF%_Uj%G7gne[dqKj,Q*~XTKBC|p<PbC5:5Y39fnyU^+*cR8LP;UaPNh&6lYupk%');
define('LOGGED_IN_SALT',   'h2W2Xh|7+8xEH`w`,4vJj8{AWgc@T9QC#I=-7#@AG9#)X!&!l)r1Il=WBCcY*wJ|');
define('NONCE_SALT',       'QgBE+tF$nUP@pqu;/cDP+f64P-#O-yozqgF{;5%+f)&4%P={3GJA+<Gv4J5+/AmL');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */

//disable WP Post Revisions
define('AUTOSAVE_INTERVAL', 300); // seconds
define('WP_POST_REVISIONS', false);
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');