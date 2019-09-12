<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreatePlayersTable.
 */
class CreatePlayersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('players', function(Blueprint $table) {
            $table->increments('id');
          	$table->boolean('chance_of_playing_next_round')->nullable();
          	$table->boolean('chance_of_playing_this_round')->nullable();
          	$table->integer('code')->nullable();
          	$table->integer('now_cost')->default(0);
            $table->integer('cost_change_event')->default(0);
          	$table->integer('cost_change_event_fall')->default(0);
          	$table->integer('cost_change_start')->default(0);
          	$table->integer('cost_change_start_fall')->default(0);
            $table->integer('dreamteam_count')->default(0);
          	$table->integer('element_type')->nullable();
            $table->decimal('ep_next')->default(0.0);
            $table->decimal('ep_this')->default(0.0);
            $table->integer('event_points')->default(0);
            $table->string('first_name', 120)->nullable();
            $table->string('second_name', 120)->nullable();
            $table->decimal('form')->default(0.0);
            $table->integer('player_id')->nullable();
            $table->boolean('in_dreamteam')->default(0);
            $table->string('news')->nullable();
            $table->string('news_added')->nullable();;
            $table->string('photo', 50)->nullable();
            $table->decimal('points_per_game')->default(0.0);
            $table->decimal('selected_by_percent')->default(0.0);
            $table->boolean('special')->default(0);
            $table->integer('squad_number')->nullable();
            $table->char('status', 1)->nullable();
            $table->integer('team')->nullable();
            $table->integer('team_code')->nullable();
            $table->integer('total_points')->default(0);
            $table->integer('transfers_in')->nullable();
            $table->integer('transfers_in_event')->nullable();
            $table->integer('transfers_out')->nullable();
            $table->integer('transfers_out_event')->nullable();
            $table->decimal('value_form')->default(0.0);
            $table->decimal('value_season')->default(0.0);
            $table->string('web_name', 120)->nullable();

            $table->integer('minutes')->default(0);
            $table->integer('goals_scored')->default(0);
            $table->integer('assists')->default(0);
            $table->integer('clean_sheets')->default(0);
            $table->integer('goals_conceded')->default(0);
            $table->integer('own_goals')->default(0);
            $table->integer('penalties_saved')->default(0);
            $table->integer('penalties_missed')->default(0);
            $table->integer('yellow_cards')->default(0);
            $table->integer('red_cards')->default(0);
            $table->integer('saves')->default(0);
            $table->integer('bonus')->default(0);
            $table->integer('bps')->default(0);

            $table->decimal('influence')->default(0.0);
            $table->decimal('creativity')->default(0.0);
            $table->decimal('threat')->default(0.0);
            $table->decimal('ict_index')->default(0.0);

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
		Schema::drop('players');
	}
}
