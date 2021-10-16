<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link http://wpdocs.osdn.jp/wp-config.php_%E3%81%AE%E7%B7%A8%E9%9B%86
 *
 * @package WordPress
 */

// 注意:
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.osdn.jp/%E7%94%A8%E8%AA%9E%E9%9B%86#.E3.83.86.E3.82.AD.E3.82.B9.E3.83.88.E3.82.A8.E3.83.87.E3.82.A3.E3.82.BF 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define('DB_NAME', 'LAA1212207-9v1jm4');

/** MySQL データベースのユーザー名 */
define('DB_USER', 'LAA1212207');

/** MySQL データベースのパスワード */
define('DB_PASSWORD', 'a0Z4U1is');

/** MySQL のホスト名 */
define('DB_HOST', 'mysql147.phy.lolipop.lan');

/** データベースのテーブルを作成する際のデータベースの文字セット */
define('DB_CHARSET', 'utf8');

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define('DB_COLLATE', '');

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define('AUTH_KEY', ';~f%9)/0A@3=PflXW;cM-j#}C<~,w`&G>k9uW~:FksjLvq]i>57pOG*QM#fG{uRp');
define('SECURE_AUTH_KEY', 'UB5PI/|_b2&F3(qfOrusp,EXdMD]z@6JfeJ@I2zB(10P_xYt^>i!f2sM_x@[>PEe');
define('LOGGED_IN_KEY', ',d+JE7,%o}p:GMQ.MJwG/rE/fO9Q($9RW0Sh;GcCEJX^oXvKYrxYfSCznE|!TD":');
define('NONCE_KEY', 'SYu~lGUY8[_(|-s)Ap;`g[0f*s-)fJf]`n4h6GZX|:1a.?#%0yYVH~Mg|xx_9d^t');
define('AUTH_SALT', '|M;SBs75F4iHxiU>9)5.F%F4s5Lm2NEGETEB-PU?_elB~#l>qkZq[)!jM$&`v(YH');
define('SECURE_AUTH_SALT', 'P9G,&>b,7,Y:vcM5")|lZ6Qrst@ytZR`G~}5GNzT_WcOQi5_fy=cQn6E0c{+;<dP');
define('LOGGED_IN_SALT', 'd2EE#qg{,NoX~,<<|N]jL4Xf{5?|(=V*((Y.VQp{+.2%xxeak4srd2U?P%8G`j;s');
define('NONCE_SALT', '~l}){jrw]Gn_UJ2u+|tJNe=lsp)5+ax66;^PIcq<*X0TNk(T$g<R+b>WuwM1iIm$');

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix  = 'wp20201012035027_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数については Codex をご覧ください。
 *
 * @link http://wpdocs.osdn.jp/WordPress%E3%81%A7%E3%81%AE%E3%83%87%E3%83%90%E3%83%83%E3%82%B0
 */
define('WP_DEBUG', false);

/* 編集が必要なのはここまでです ! WordPress でブログをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
  define('ABSPATH', dirname(__FILE__) . '/');
}

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
