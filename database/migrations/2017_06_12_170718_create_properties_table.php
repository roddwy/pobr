<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->date('admission_date');
            $table->decimal('sale_price',13,2);
            $table->decimal('offer_price',13,2);
            $table->decimal('comission',13,2);
            $table->string('financing');
            $table->string('building');
            $table->string('piso');
            $table->string('no_dpto');
            $table->string('referencies');
            $table->string('antiquily');
            $table->string('legal_document');
            $table->string('avaluo');
            $table->string('delivery_time');
            $table->string('additional_inf');
            $table->string('bedrooms');
            $table->string('kitchens');
            $table->string('bathrooms');
            $table->string('livingrooms');
            $table->string('garages');
            $table->string('asensors');
            $table->string('suite');
            $table->string('pantry');
            $table->string('deskrooms');
            $table->string('servicesrooms');
            $table->string('storages');
            $table->string('others');
            $table->text('description');
            $table->string('surface_area');
            $table->string('surface_builder');
            $table->string('street');
            $table->double('lat_map', 15, 8);
            $table->double('lng_map', 15, 8);
            $table->integer('zone_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('type_property_id')->unsigned();
            $table->integer('owner_current_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('state_id')->unsigned();

            $table->foreign('zone_id')->references('id')->on('zones')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('type_property_id')->references('id')->on('types_properties')->onDelete('cascade');
            $table->foreign('owner_current_id')->references('id')->on('owners_currents')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('properties');
    }
}
