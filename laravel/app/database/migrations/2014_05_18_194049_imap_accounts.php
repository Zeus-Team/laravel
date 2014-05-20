<?php
/**
* ImapAccounts  
* 
* ImapAccounts for database of migration
* 
* @author Badiul Valentin
* @version 1.0.0
*/
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ImapAccounts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('imap_accounts',function($table){
			$table->increments('id');
			$table->string('hostname');
			$table->string('username');
			$table->string('password');
			$table->text('info');
			$table->timestamps(); 
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Shema::drop('imap_accounts');
	}

}
