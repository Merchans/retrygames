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
	 * @link https://wordpress.org/support/article/editing-wp-config-php/
	 *
	 * @package WordPress
	 */
	define( 'WP_TEMP_DIR', ABSPATH . 'wp-content/' );
// ** MySQL settings - You can get this info from your web host ** //
	define( 'WP_TEMP_DIR', ABSPATH . 'wp-content/' );
	/** The name of the database for WordPress */
	define( 'DB_NAME', 'ete34e_2021ls_09' );

	/** MySQL database username */
	define( 'DB_USER', 'ete34e_2021ls_09' );

	/** MySQL database password */
	define( 'DB_PASSWORD', '0dTvOh' );

	/** MySQL hostname */
	define( 'DB_HOST', '' );

	/** Database Charset to use in creating database tables. */
	define( 'DB_CHARSET', 'utf8mb4' );

	/** The Database Collate type. Don't change this if in doubt. */
	define( 'DB_COLLATE', '' );

	/**#@+
	 * Authentication Unique Keys and Salts.
	 *
	 * Change these to different unique phrases!
	 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
	 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
	 *
	 * @since 2.6.0
	 */
	define( 'AUTH_KEY', 'f/E_{zKxlksKV4r?Q0g8%9a8<HMuWmLQ2z&H@r_ORXP-xo6MWj8Z*I>HbK[Y;7E7' );
	define( 'SECURE_AUTH_KEY', 'x@)yDGPU1:6zZ2-!HZ6=`,7,!@3.Q)R50B7&yn.bJ2`B6WO)p-V?.zyc6F9Z.1+A' );
	define( 'LOGGED_IN_KEY', 'Bg}ym=PEhn[KD@$aNC/<1ev[_E|=9q,_v&ob?VS!^RAARY.&_OQ}:+DG1dlu[S)S' );
	define( 'NONCE_KEY', ')Yw*I?XqbK/$6.F~4)GGiDg?iGY-B^E%2<v?zW`t4:}l6mEc-vXJ|Az|e?vu,d4e' );
	define( 'AUTH_SALT', '@[5/4n4YZI@=WiR5ZF7UgB]GPAyV#/bvr}rZ2}v<l!jgJi2@ouMcgj*elCX3hx(+' );
	define( 'SECURE_AUTH_SALT', '[DP`}(/Kill5Bk_t$O%eI:7L.pgGW7A&qh8DMR>+KMBzl.vb.G6;<~_3f&^Grv=L' );
	define( 'LOGGED_IN_SALT', '^*cv:fiy!cS(6-K`f37=_OQBdX>v}WvUuXmc1EaBmS5o#}C>|b@!UH)tdIqB^^%d' );
	define( 'NONCE_SALT', 'F*P6udm<QgexJ=z*c,%vr](AK}J@lm`xJ62Vg&c4#`3#aPj,:!u[&O:c_T?OaNcR' );

	/**#@-*/

	/**
	 * WordPress Database Table prefix.
	 *
	 * You can have multiple installations in one database if you give each
	 * a unique prefix. Only numbers, letters, and underscores please!
	 */
	$table_prefix = 're_try';

	/**
	 * For developers: WordPress debugging mode.
	 *
	 * Change this to true to enable the display of notices during development.
	 * It is strongly recommended that plugin and theme developers use WP_DEBUG
	 * in their development environments.
	 *
	 * For information on other constants that can be used for debugging,
	 * visit the documentation.
	 *
	 * @link https://wordpress.org/support/article/debugging-in-wordpress/
	 */
	define( 'WP_DEBUG', false );

	/* That's all, stop editing! Happy publishing. */

	/** Absolute path to the WordPress directory. */
	if ( ! defined( 'ABSPATH' ) ) {
		define( 'ABSPATH', __DIR__ . '/' );
	}

	/** Sets up WordPress vars and included files. */
	require_once ABSPATH . 'wp-settings.php';
	define( 'FS_METHOD', 'direct' );
