<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Verification Routes
Route::post('verify-email', 'VerificationController@verify');
Route::post('email-validation', 'VerificationController@emailValidation');
Route::post('confirm-email/{id}', 'VerificationController@confirm');
Route::get('check-email/{email}', 'UserController@checkUserEmail');

// Password Routes
Route::post('forget-password-email', 'ForgetPasswordController@email');
Route::post('reset-password/{id}', 'ForgetPasswordController@updatePassword');

// User Register Route
Route::post('register', 'UserController@register');

// Pessoa FIsica Registers Routes
Route::post('register-pf', 'PessoaFisicaController@register');
Route::post('register-atividade-pf', 'AtividadePessoaFisicaController@register');
Route::post('register-apresentacao-pf', 'ApresentacaoPessoaFisicaController@register');
Route::post('register-endereco-pf', 'EnderecoPessoaFisicaController@register');
Route::post('registro-inicial-pf', 'RegistroInicialPessoaFisicaController@register');
Route::post('check-cpf', 'PessoaFisicaController@checkCpf');

// Pessoa Juridica Registers Routes
Route::post('register-pj', 'PessoaJuridicaController@register');
Route::post('register-atividade-pj', 'AtividadePessoaJuridicaController@register');
Route::post('register-apresentacao-pj', 'ApresentacaoPessoaJuridicaController@register');
Route::post('register-endereco-pj', 'EnderecoPessoaJuridicaController@register');
Route::post('registro-inicial-pj', 'RegistroInicialPessoaJuridicaController@register');
Route::post('check-cnpj', 'PessoaJuridicaController@checkCnpj');

// Unidades Registers Routes
Route::post('registro-inicial-unidade', 'RegistroInicialUnidadeController@register');
Route::post('check-cnpj-unidade', 'UnidadeController@checkCnpj');

// Login Route
Route::post('login', 'UserController@authenticate');

// Activities Routes
Route::get('atividades', 'AtividadeController@index');
Route::get('atividades/{id}', 'AtividadeController@show');
Route::get('activities-pf-count', 'AtividadePessoaFisicaController@activitiesCount');
Route::get('activities-pj-count', 'AtividadePessoaJuridicaController@activitiesCount');
Route::get('atividades-relatorio', 'AtividadesRelatorioController@relatorio');

// Avatar Routes
Route::post('avatar/{id}/{filename}', 'AvatarController@update');
Route::get('avatar/{id}', 'AvatarController@show');
Route::delete('avatar/{id}', 'AvatarController@delete');
Route::post('avatar-unidade/{id}/{unidadeId}/{filename}', 'AvatarController@updateAvatarUnidade');
Route::get('avatar-unidade/{id}/{unidadeId}', 'AvatarController@showUnidadeAvatar');
Route::delete('avatar-unidade/{id}/{unidadeId}', 'AvatarController@deleteUnidadeAvatar');

// Banner Routes
Route::get('banner/{id}/top', 'ArquivosController@showTop');
Route::get('banner/{id}/side', 'ArquivosController@showSide');
Route::get('banner-simple-user/{id}/top', 'ArquivosController@showTopSimpleUser');
Route::get('banner-simple-user/{id}/side', 'ArquivosController@showSideSimpleUser');
Route::post('banner-simple-user/{id}/{local}/{filename}', 'ArquivosController@storeBannerSimpleUser');

// Friend Indication Routes
Route::post('friend-indication-email', 'FriendIndicationController@email');
Route::post('friend-indication-sms', 'FriendIndicationController@sms');
Route::get('friend-indications', 'FriendIndicationController@index');
Route::post('friend-indication', 'FriendIndicationController@create');
Route::put('friend-indication/{id}', 'FriendIndicationController@update');

// Email Contact Route
Route::post('contato-email', 'ContatoEmailController@email');

// Cotation Route
Route::post('cotacao', 'CotacaoController@create');

// Search Clients Route
Route::post('pesquisa-clientes', 'PesquisaClientesController@pesquisa');

// Pessoa Fisica Resume Route
Route::get('pessoa-fisica-resumo/{id}', 'ApresentacaoPessoaFisicaController@show');

// Endereco Pessoa Fisica Route
Route::get('endereco-pfs', 'EnderecoPessoaFisicaController@index');

// Resume Pessoa Juridica Route
Route::get('pessoa-juridica-resumo/{id}', 'ApresentacaoPessoaJuridicaController@show');

// Endereco Pessoa Juridica Routes
Route::get('endereco-pjs', 'EnderecoPessoaJuridicaController@index');

// File and images Routes
Route::get('arquivos/{id}', 'ArquivosController@index');
Route::post('arquivos/{id}/{filename}', 'ArquivosController@store');
Route::post('arquivos-unidade/{id}/{filename}', 'ArquivosController@storeUnidadeImg');
Route::get('arquivos-imagens-index/{id}', 'ArquivosController@imagensIdx');
Route::get('imagens-unidade-index/{id}', 'ArquivosController@imagensUnidadeIdx');
Route::get('slide-imagens', 'ArquivosController@slideImgIdx');

// Credenciados Route
Route::get('credenciados', 'CredenciadoController@index');

// Newsletter Route
Route::post('newsletter', 'NewsletterController@create');

Route::post('store-curriculo/{directory}/{filename}', 'CurriculoController@storeCurriculo');
Route::post('curriculo', 'CurriculoController@create');

// Check CNPJ Unities Route
Route::post('check-cnpj-unidade', 'UnidadeController@checkCnpj');

// Ads Routes
Route::get('propagandas/{cidade}/{estado}', 'PropagandaPessoaJuridicaController@index');

// Users Ads Routes
Route::post('user-propaganda-register', 'UsersPropagandaController@register');
Route::get('user-propagandas', 'UsersPropagandaController@index');
Route::get('user-propaganda/{id}', 'UsersPropagandaController@show');
Route::post('propaganda-user', 'PropagandaUserController@create');
Route::get('propagandas-simple-user/{cidade}/{estado}', 'PropagandaUserController@index');

// Pagseguro Route
Route::post('pagseguro-checkout', 'PagseguroController@checkout');

// Routes that requires JWT
Route::middleware(['jwt.verify', 'cors'])->group(function() {

    // users Routes
    Route::get('user', 'UserController@getAuthenticatedUser');
    Route::get('user/{id}', 'UserController@user');
    Route::delete('user/{id}', 'UserController@delete');
    Route::put('user/{id}', 'UserController@update');
    Route::put('user-reset-password/{id}', 'UserController@updatePassword');

    // Pessoa Juridica Routes
    Route::get('pessoa-juridica/{id}', 'PessoaJuridicaController@show');
    Route::put('pessoa-juridica/{id}', 'PessoaJuridicaController@update');
    Route::get('endereco-pj/{id}', 'EnderecoPessoaJuridicaController@show');
    Route::put('endereco-pj/{id}', 'EnderecoPessoaJuridicaController@update');
    Route::get('apresentacao-pj/{id}', 'ApresentacaoPessoaJuridicaController@show');
    Route::put('apresentacao-pj/{id}', 'ApresentacaoPessoaJuridicaController@update');
    Route::get('atividade-pj/{id}', 'AtividadePessoaJuridicaController@show');
    Route::put('atividade-pj/{id}', 'AtividadePessoaJuridicaController@update');

    // Pessoa Fisica ROutes
    Route::get('pessoa-fisica/{id}', 'PessoaFisicaController@show');
    Route::put('pessoa-fisica/{id}', 'PessoaFisicaController@update');
    Route::get('endereco-pf/{id}', 'EnderecoPessoaFisicaController@show');
    Route::put('endereco-pf/{id}', 'EnderecoPessoaFisicaController@update');
    Route::get('apresentacao-pf/{id}', 'ApresentacaoPessoaFisicaController@show');
    Route::put('apresentacao-pf/{id}', 'ApresentacaoPessoaFisicaController@update');
    Route::get('atividade-pf/{id}', 'AtividadePessoaFisicaController@show');
    Route::put('atividade-pf/{id}', 'AtividadePessoaFisicaController@update');

    // Unities Routes
    Route::get('unidades/{id}', 'UnidadeController@list');
    Route::put('unidade/{id}', 'UnidadeController@update');
    Route::get('endereco-unidade/{id}', 'EnderecoUnidadeController@show');
    Route::put('endereco-unidade/{id}', 'EnderecoUnidadeController@update');
    Route::get('atividade-unidade/{id}', 'AtividadeUnidadeController@show');
    Route::put('atividade-unidade/{id}', 'AtividadeUnidadeController@update');
    Route::get('apresentacao-unidade/{id}', 'ApresentacaoUnidadeController@show');
    Route::put('apresentacao-unidade/{id}', 'ApresentacaoUnidadeController@update');

    // Ads Routes
    Route::get('propaganda-pj/{id}', 'PropagandaPessoaJuridicaController@show');
    Route::post('propaganda-pj', 'PropagandaPessoaJuridicaController@create');
    Route::get('propaganda-unidade/{id}', 'PropagandaUnidadeController@show');
    Route::post('propaganda-unidade', 'PropagandaUnidadeController@create');
    Route::put('propaganda-pj/{id}', 'PropagandaPessoaJuridicaController@update');
    Route::put('propaganda-unidade/{id}', 'PropagandaUnidadeController@update');

    // Messages Routes
    Route::post('mensagem', 'MensagemController@create');
    Route::get('mensagens/{id}/{tipoPessoa}', 'MensagemController@mensagensUser');
    Route::put('mensagens/{id}', 'MensagemController@update');
    Route::put('mensagens/{id}', 'MensagemController@updateCol');
    Route::put('mensagens-unread/{id}', 'MensagemController@updateUnreadCol');

    // Cotations Route
    Route::post('cotacao-user', 'CotacaoController@index');

    // Cotations Read Routes
    Route::post('cotacao-lida', 'CotacaoLidaController@setAsRead');
    Route::post('cotacao-lida-col', 'CotacaoLidaController@setAsReadCol');
    Route::put('cotacao-lida-col-unread', 'CotacaoLidaController@setAsUnreadCol');
    Route::put('cotacao-lida/{id}', 'CotacaoLidaController@changeReadStatus');
    Route::get('cotacao-lida/{id}', 'CotacaoLidaController@getCotRead');

    // Activites Routes
    Route::post('atividade', 'AtividadeController@register');
    Route::delete('atividade/{id}', 'AtividadeController@delete');

    // Slide Images Routes
    Route::post('slide-imagem/{filename}/{ordem}', 'ArquivosController@storeSlideImg');
    Route::delete('slide-imagem/{filename}', 'ArquivosController@deleteSlideImg');

    // Newsletter Routes
    Route::get('newsletters', 'NewsletterController@index');
    Route::delete('newsletter/{id}', 'NewsletterController@delete');

    // banners Route
    Route::post('banner/{id}/{local}/{filename}', 'ArquivosController@storeBanner');

    // Files Route
    Route::delete('arquivos/{id}/{filename}', 'ArquivosController@delete');
});
