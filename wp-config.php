<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('REVISR_GIT_PATH', 'C:\Users\Abe\Documents\GitHub'); // Added by Revisr
define('DB_NAME', 'wp_idealseed');

/** MySQL database username */
define('DB_USER', 'idealseed');

/** MySQL database password */
define('DB_PASSWORD', 'idealseed');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         '.*cZ~i_8T* +V4o`F5Ve3I2we9yUuAxL5M-SQ-g%]J17?2Yk.5~*y:e}(9],Zm3I');
define('SECURE_AUTH_KEY',  '^yOt^*/3!.JJ%{+c,S(7e6O@0c+-tLFJU&F[y1pf|WvPp{BHb4&+F0B6C<1*)xAu');
define('LOGGED_IN_KEY',    'HE,88e+^:5GZLAxuc}16.#,pDy7e$:d/gT5Rh[ *Q-*D8.d{- ~9/WIG*(}}:uYT');
define('NONCE_KEY',        'M5y?.BKN6C)+%1>.v5r=pvk,GlkfBGn]N{Hv|SrLDee+>o.!%fU(d{h(V^*ZR`8p');
define('AUTH_SALT',        'P*D,Ojw?EY@{_A($(ke, Yc.z9[c?0Ee4oov]{KRo3uM2+yF!:uBK}8ZZ:iWZ7 q');
define('SECURE_AUTH_SALT', 'cVSwNQnK:9BBCxu6X*m<Uiwu[7*80RK<]=KU$?[.@p(q3bp]D+q&;kDs@M0CjiF(');
define('LOGGED_IN_SALT',   'gi.F u1og,Vzy}gJ|.7^%!+lYv|4[#3IOOsf[,@X3V{ro+*aF)<.rK)Mr0gi7~$d');
define('NONCE_SALT',       'B&j4/-<-5<zzg6ZDJ:~ra#GXjS{tDA>%G}-Zkn OS{&|mkKF}sP:dPuQ*{9#%Yh1');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
