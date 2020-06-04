<?php
Route::group([
    'prefix'     => 'master',
    'namespace' => 'Master',
], function()
{
    Route::get('send_money','PagesController@sendMoney_View')->name('master.sendMoney_View');
    Route::get('receivedMoney_View','PagesController@receivedMoney_View')->name('master.receivedMoney_View');
    Route::get('sentMoneyReport_View','PagesController@sentMoneyReport_View')->name('master.sentMoneyReport_View');
});

//Master page controller routes for all the operations
