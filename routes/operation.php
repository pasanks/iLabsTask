<?php
Route::group([
    'prefix'     => 'master',
    'namespace' => 'Master',//file path
], function()
{
    Route::post('sendMoneyRequest','OperationController@sendMoneyRequest')->name('master.sendMoneyRequest');
    Route::get('receivedMoney_getDataForDT','OperationController@receivedMoney_getDataForDT')->name('master.receivedMoney_getDataForDT');
    Route::get('sendMoneyReport_getDataForDT','OperationController@sendMoneyReport_getDataForDT')->name('master.sendMoneyReport_getDataForDT');
});

//Operation controller routes goes in here
