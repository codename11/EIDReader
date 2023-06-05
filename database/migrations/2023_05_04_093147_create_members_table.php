<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string("surname");
            $table->string("parentGivenName");
            $table->string("givenName");
            $table->string("dateOfBirth");
            $table->string("placeOfBirth");
            $table->string("stateOfBirth");
            $table->string("docRegNo");
            $table->string("personalNumber");
            $table->string("issuingDate");
            $table->string("expiryDate");
            $table->string("portrait");
            $table->unsignedBigInteger('role_id')->nullable();
            $table->foreign("role_id")->references("id")->on("role")->onUpdate('cascade')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });

        DB::table("members")->insert(
            array(
                    [
                    "surname" => "МИТРОВИЋ",
                    "parentGivenName" => "МИТАР",
                    "givenName" => "ЖИКА",
                    "dateOfBirth" => "12.09.1963",
                    "placeOfBirth" => "SMEDEREVO",
                    "stateOfBirth" => "REPUBLIKA SRBIJA",
                    "docRegNo" => "890452473",
                    "personalNumber" => "890452473837",
                    "issuingDate" => "06.09.2022",
                    "expiryDate" => "06.09.2032",
                    "portrait" => "890452473/avatar.jpg",
                    "role_id" => 1,
                    "created_at" => NOW(),
                    "updated_at" => NOW(),
                    ]
                )
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
