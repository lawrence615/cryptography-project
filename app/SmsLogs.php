<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsLogs extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sms_logs';


    protected $fillable = ['status', 'user_id'];

}
