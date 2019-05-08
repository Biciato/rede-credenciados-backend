<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('verify-email', 'VerificationController@verify');
Route::post('email-validation', 'VerificationController@emailValidation');
Route::post('confirm-email/{id}', 'VerificationController@confirm');
Route::post('forget-password-email', 'ForgetPasswordController@email');
Route::post('reset-password/{id}', 'ForgetPasswordController@updatePassword');

Route::get('check-email/{email}', 'UserController@checkUserEmail');

Route::post('register', 'UserController@register');

Route::post('register-pf', 'PessoaFisicaController@register');
Route::post('register-atividade-pf', 'AtividadePessoaFisicaController@register');
Route::post('register-apresentacao-pf', 'ApresentacaoPessoaFisicaController@register');
Route::post('register-endereco-pf', 'EnderecoPessoaFisicaController@register');
Route::post('registro-inicial-pf', 'RegistroInicialPessoaFisicaController@register');
Route::post('check-cpf', 'PessoaFisicaController@checkCpf');

Route::post('register-pj', 'PessoaJuridicaController@register');
Route::post('register-atividade-pj', 'AtividadePessoaJuridicaController@register');
Route::post('register-apresentacao-pj', 'ApresentacaoPessoaJuridicaController@register');
Route::post('register-endereco-pj', 'EnderecoPessoaJuridicaController@register');
Route::post('registro-inicial-pj', 'RegistroInicialPessoaJuridicaController@register');
Route::post('check-cnpj', 'PessoaJuridicaController@checkCnpj');

Route::post('check-cnpj-unidade', 'UnidadeController@checkCnpj');

Route::post('login', 'UserController@authenticate');

Route::post('registro-inicial-unidade', 'RegistroInicialUnidadeController@register');

Route::get('atividades', 'AtividadeController@index');
Route::get('atividades/{id}', 'AtividadeController@show');
Route::get('activities-pf-count', 'AtividadePessoaFisicaController@activitiesCount');
Route::get('activities-pj-count', 'AtividadePessoaJuridicaController@activitiesCount');

Route::get('atividades-relatorio', 'AtividadesRelatorioController@relatorio');

Route::post('avatar/{id}/{filename}', 'AvatarController@update');
Route::get('avatar/{id}', 'AvatarController@show');
Route::delete('avatar/{id}', 'AvatarController@delete');
Route::post('avatar-unidade/{id}/{unidadeId}/{filename}', 'AvatarController@updateAvatarUnidade');
Route::get('avatar-unidade/{id}/{unidadeId}', 'AvatarController@showUnidadeAvatar');
Route::delete('avatar-unidade/{id}/{unidadeId}', 'AvatarController@deleteUnidadeAvatar');

Route::get('banner/{id}/top', 'ArquivosController@showTop');
Route::get('banner/{id}/side', 'ArquivosController@showSide');
Route::get('banner-simple-user/{id}/top', 'ArquivosController@showTopSimpleUser');
Route::get('banner-simple-user/{id}/side', 'ArquivosController@showSideSimpleUser');
Route::post('banner-simple-user/{id}/{local}/{filename}', 'ArquivosController@storeBannerSimpleUser');

Route::post('friend-indication-email', 'FriendIndicationController@email');
Route::post('friend-indication-sms', 'FriendIndicationController@sms');

Route::post('contato-email', 'ContatoEmailController@email');

Route::post('cotacao', 'CotacaoController@create');

Route::post('pesquisa-clientes', 'PesquisaClientesController@pesquisa');

Route::get('pessoa-fisica-resumo/{id}', 'ApresentacaoPessoaFisicaController@showResumo');

Route::get('endereco-pfs', 'EnderecoPessoaFisicaController@index');

Route::get('pessoa-juridica-resumo/{id}', 'ApresentacaoPessoaJuridicaController@showResumo');

Route::get('endereco-pjs', 'EnderecoPessoaJuridicaController@index');

Route::get('arquivos/{id}', 'ArquivosController@index');
Route::post('arquivos/{id}/{filename}', 'ArquivosController@store');
Route::post('arquivos-unidade/{id}/{filename}', 'ArquivosController@storeUnidadeImg');
Route::get('arquivos-imagens-index/{id}', 'ArquivosController@imagensIdx');
Route::get('imagens-unidade-index/{id}', 'ArquivosController@imagensUnidadeIdx');
Route::get('slide-imagens', 'ArquivosController@slideImgIdx');

Route::get('credenciados', 'CredenciadoController@index');

Route::post('newsletter', 'NewsletterController@create');

Route::post('store-curriculo/{directory}/{filename}', 'CurriculoController@storeCurriculo');
Route::post('curriculo', 'CurriculoController@create');

Route::post('check-cnpj-unidade', 'UnidadeController@checkCnpj');

Route::get('propagandas/{cidade}/{estado}', 'PropagandaPessoaJuridicaController@index');

Route::post('user-propaganda-register', 'UsersPropagandaController@register');
Route::get('user-propagandas', 'UsersPropagandaController@index');
Route::get('user-propaganda/{id}', 'UsersPropagandaController@show');
Route::post('propaganda-user', 'PropagandaUserController@create');
Route::get('propagandas-simple-user/{cidade}/{estado}', 'PropagandaUserController@index');

Route::post('pagseguro-checkout', 'PagseguroController@checkout');

Route::get('friend-indications', 'FriendIndicationController@index');
Route::post('friend-indication', 'FriendIndicationController@create');
Route::put('friend-indication/{id}', 'FriendIndicationController@update');

Route::middleware(['jwt.verify', 'cors'])->group(function() {
    Route::get('user', 'UserController@getAuthenticatedUser');
    Route::get('user/{id}', 'UserController@user');
    Route::delete('user/{id}', 'UserController@delete');
    Route::put('user/{id}', 'UserController@update');
    Route::put('user-reset-password/{id}', 'UserController@updatePassword');

    Route::get('pessoa-juridica/{id}', 'PessoaJuridicaController@show');
    Route::put('pessoa-juridica/{id}', 'PessoaJuridicaController@update');
    Route::get('endereco-pj/{id}', 'EnderecoPessoaJuridicaController@show');
    Route::put('endereco-pj/{id}', 'EnderecoPessoaJuridicaController@update');
    Route::get('apresentacao-pj/{id}', 'ApresentacaoPessoaJuridicaController@show');
    Route::put('apresentacao-pj/{id}', 'ApresentacaoPessoaJuridicaController@update');
    Route::get('atividade-pj/{id}', 'AtividadePessoaJuridicaController@show');
    Route::put('atividade-pj/{id}', 'AtividadePessoaJuridicaController@update');

    Route::get('pessoa-fisica/{id}', 'PessoaFisicaController@show');
    Route::put('pessoa-fisica/{id}', 'PessoaFisicaController@update');
    Route::get('endereco-pf/{id}', 'EnderecoPessoaFisicaController@show');
    Route::put('endereco-pf/{id}', 'EnderecoPessoaFisicaController@update');
    Route::get('apresentacao-pf/{id}', 'ApresentacaoPessoaFisicaController@show');
    Route::put('apresentacao-pf/{id}', 'ApresentacaoPessoaFisicaController@update');
    Route::get('atividade-pf/{id}', 'AtividadePessoaFisicaController@show');
    Route::put('atividade-pf/{id}', 'AtividadePessoaFisicaController@update');

    Route::get('unidades/{id}', 'UnidadeController@list');
    Route::put('unidade/{id}', 'UnidadeController@update');
    Route::get('endereco-unidade/{id}', 'EnderecoUnidadeController@show');
    Route::put('endereco-unidade/{id}', 'EnderecoUnidadeController@update');
    Route::get('atividade-unidade/{id}', 'AtividadeUnidadeController@show');
    Route::put('atividade-unidade/{id}', 'AtividadeUnidadeController@update');
    Route::get('apresentacao-unidade/{id}', 'ApresentacaoUnidadeController@show');
    Route::put('apresentacao-unidade/{id}', 'ApresentacaoUnidadeController@update');

    Route::get('propaganda-pj/{id}', 'PropagandaPessoaJuridicaController@show');
    Route::post('propaganda-pj', 'PropagandaPessoaJuridicaController@create');
    Route::get('propaganda-unidade/{id}', 'PropagandaUnidadeController@show');
    Route::post('propaganda-unidade', 'PropagandaUnidadeController@create');
    Route::put('propaganda-pj/{id}', 'PropagandaPessoaJuridicaController@update');
    Route::put('propaganda-unidade/{id}', 'PropagandaUnidadeController@update');

    Route::post('mensagem', 'MensagemController@create');
    Route::get('mensagens/{id}', 'MensagemController@mensagensUser');
    Route::put('mensagens/{id}', 'MensagemController@update');
    Route::put('mensagens', 'MensagemController@updateCol');
    Route::put('mensagens-unread', 'MensagemController@updateUnreadCol');

    Route::post('cotacao-user', 'CotacaoController@index');

    Route::post('cotacao-lida', 'CotacaoLidaController@setAsRead');
    Route::post('cotacao-lida-col', 'CotacaoLidaController@setAsReadCol');
    Route::put('cotacao-lida-col-unread', 'CotacaoLidaController@setAsUnreadCol');
    Route::put('cotacao-lida/{id}', 'CotacaoLidaController@changeReadStatus');
    Route::get('cotacao-lida/{id}', 'CotacaoLidaController@getCotRead');

    Route::post('atividade', 'AtividadeController@register');
    Route::delete('atividade/{id}', 'AtividadeController@delete');

    Route::post('slide-imagem/{filename}/{ordem}', 'ArquivosController@storeSlideImg');
    Route::delete('slide-imagem/{filename}', 'ArquivosController@deleteSlideImg');

    Route::get('newsletters', 'NewsletterController@index');
    Route::delete('newsletter/{id}', 'NewsletterController@delete');

    Route::post('banner/{id}/{local}/{filename}', 'ArquivosController@storeBanner');

    Route::delete('arquivos/{id}/{filename}', 'ArquivosController@delete');
});
