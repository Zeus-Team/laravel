<?php
/**
* AddImapAccounts
* 
* AddImapAccounts for database of migration
* 
* @author Badiul Valentin
* @version 1.0.0
*/
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImapAccounts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('imap_accounts')->insert(array( 
			'hostname'  => '{imap.gmail.com:993/imap/ssl}INBOX',
			'username'  => 'thelaravelimap@gmail.com',
			'password'  => "qawsedrftgyhujikolp;['",
			'created_at' => date('Y-m-d H:m:s'),
			'updated_at' => date('Y-m-d H:m:s'),
		)); 

		DB::table('imap_accounts')->insert(array( 
			'hostname'   => '{mail.ukraine.com.ua}',
			'username'   => 'b@valentin.in.ua',
			'password'   => "c4Iy1r2F",
			'created_at' => date('Y-m-d H:m:s'),
			'updated_at' => date('Y-m-d H:m:s'),
		));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('imap_accounts')->where('username', '=' , 'thelaravelimap@gmail.com')-> delete();
		DB::table('imap_accounts')->where('username', '=' , 'b@valentin.in.ua')-> delete();
	}

}
