<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/installbd', function (Request $request, Response $response, array $args) {
   $this->db;
   $capsule = new \Illuminate\Database\Capsule\Manager;

    $capsule::schema()->dropIfExists('jeux_db');

    $capsule::schema()->create('jeux_db', function (\Illuminate\Database\Schema\Blueprint $table) {
        $table->increments('id');
        $table->string('nom');
        $table->string('categorie');
        $table->string('editeur');
        $table->string('image');
        $table->string('date');
        $table->integer('note')->default(0);
        $table->float('prix')->default(0);
        $table->integer('ps4')->default(0);
        $table->integer('xbox_one')->default(0);
        $table->integer('switch')->default(0);
        $table->integer('pc')->default(0);
        $table->integer('ps3')->default(0);
        $table->integer('xbox_360')->default(0);
        $table->integer('vente')->default(0);
        $table->integer('panier')->default(0);
        
    });

});


$app->get('/jeux_page1', function (Request $request, Response $response, array $args){

	$this->db;

	$jeux = Jeux::all();
	
	return $this->renderer->render($response, 'jeux_page1.phtml', ["jeux" => $jeux]);

});

$app->post('/modifier_jeu', function (Request $request, Response $response, array $args){

	$this->db;

	$jeux = Jeux::where('id','=',$request->getParam('id'))->get();
	
	return $this->renderer->render($response, 'modifier_jeu.phtml', ["jeux" => $jeux]);

});

$app->post('/verif_modif_jeu', function (Request $request, Response $response, array $args){

	$this->db;

	$jeux = Jeux::where('id','=',$request->getParam('id'))->first();

	$jeux->Nom = $request->getParam('nom');
	$jeux->Categorie = $request->getParam('genre');
	$jeux->Editeur = $request->getParam('editeur');
	$jeux->Date = $request->getParam('date-sortie');
	$jeux->Note = $request->getParam('note');
	$jeux->Prix = $request->getParam('prix');
	$jeux->Image = $request->getParam('img');

	if(!empty($request->getParam('ps4'))){
		$jeux->PS4 = 1;
	}else{
		$jeux->PS4 = 0;
	}

	if(!empty($request->getParam('xbox_one'))){
		$jeux->XBOX_ONE = 1;
	}else{
		$jeux->XBOX_ONE = 0;
	}

	if(!empty($request->getParam('switch'))){
		$jeux->SWITCH = 1;
	}else{
		$jeux->SWITCH = 0;
	}

	if(!empty($request->getParam('pc'))){
		$jeux->PC = 1;
	}else{
		$jeux->PC = 0;
	}

	if(!empty($request->getParam('xbox_360'))){
		$jeux->XBOX_360 = 1;
	}else{
		$jeux->XBOX_360 = 0;
	}

	if(!empty($request->getParam('ps3'))){
		$jeux->PS3 = 1;
	}else{
		$jeux->PS3 = 0;
	}
	$jeux->save();
	
	return $this->renderer->render($response, 'verif_modif_jeu.phtml', ["jeux" => $jeux]);

});


$app->get('/ajout_jeu', function (Request $request, Response $response, array $args){

	$this->db;
	
	return $this->renderer->render($response, 'ajout_jeu.phtml', $args);

});

$app->post('/verif_ajout_jeu', function (Request $request, Response $response, array $args){

	$this->db;

	$jeux = new Jeux;

	$jeux->Nom = $request->getParam('nom');
	$jeux->Categorie = $request->getParam('genre');
	$jeux->Editeur = $request->getParam('editeur');
	$jeux->Date = $request->getParam('date-sortie');
	$jeux->Note = $request->getParam('note');
	$jeux->Prix = $request->getParam('prix');
	$jeux->Image = $request->getParam('img');

	if(!empty($request->getParam('ps4'))){
		$jeux->PS4 = 1;
	}else{
		$jeux->PS4 = 0;
	}

	if(!empty($request->getParam('xbox_one'))){
		$jeux->XBOX_ONE = 1;
	}else{
		$jeux->XBOX_ONE = 0;
	}

	if(!empty($request->getParam('switch'))){
		$jeux->SWITCH = 1;
	}else{
		$jeux->SWITCH = 0;
	}

	if(!empty($request->getParam('pc'))){
		$jeux->PC = 1;
	}else{
		$jeux->PC = 0;
	}

	if(!empty($request->getParam('xbox_360'))){
		$jeux->XBOX_360 = 1;
	}else{
		$jeux->XBOX_360 = 0;
	}

	if(!empty($request->getParam('ps3'))){
		$jeux->PS3 = 1;
	}else{
		$jeux->PS3 = 0;
	}

	$jeux->save();
	
	return $this->renderer->render($response, 'verif_ajout_jeu.phtml', ["jeux" => $jeux]);

});

$app->post('/verif_supp_jeu', function (Request $request, Response $response, array $args){

	$this->db;

	$jeux = Jeux::where('id','=',$request->getParam('id'))->first();

	$jeux->delete();
	
	return $this->renderer->render($response, 'verif_supp_jeu.phtml', ["jeux" => $jeux]);

});

$app->post('/panier_jeux', function (Request $request, Response $response, array $args){

	$this->db;

	$jeux = Jeux::where('id','=',$request->getParam('id'))->first();

	$jeux->Panier = 1;
	
	$jeux->save();

	$jeux = Jeux::where('Panier','=',1)->get();

	return $this->renderer->render($response, 'panier_jeux.phtml', ["jeux" => $jeux]);

});

$app->get('/panier_jeux', function (Request $request, Response $response, array $args){

	$this->db;

	$jeux = Jeux::where('Panier','=',1)->get();

	return $this->renderer->render($response, 'panier_jeux.phtml', ["jeux" => $jeux]);

});

$app->post('/nom_jeux_page1', function (Request $request, Response $response, array $args){

	$this->db;

	if(!empty($request->getParam('nom'))){

		if((!empty($request->getParam('console'))) && $request->getParam('console') != "choisir"){
		
			if( $request->getParam('console') == "PS4"){
				$jeux = Jeux::where('Nom','=',$request->getParam('nom'))->where('PS4','!=','0')->get();
			}
			else if( $request->getParam('console') == "XBOX_ONE"){
				$jeux = Jeux::where('Nom','=',$request->getParam('nom'))->where('XBOX_ONE','>','0')->get();
			}
			else if( $request->getParam('console') == "SWITCH"){
				$jeux = Jeux::where('Nom','=',$request->getParam('nom'))->where('SWITCH','>','0')->get();
			}
		}else{
			$jeux = Jeux::where('Nom','=',$request->getParam('nom'))->get();
		}
	}

	else if((!empty($request->getParam('console'))) && $request->getParam('console') != "choisir"){
		
		if( $request->getParam('console') == "PS4"){
			$jeux = Jeux::where('PS4','!=','0')->get();
		}
		else if( $request->getParam('console') == "XBOX_ONE"){
			$jeux = Jeux::where('XBOX_ONE','>','0')->get();
		}
		else if( $request->getParam('console') == "SWITCH"){
			$jeux = Jeux::where('SWITCH','>','0')->get();
		}
	}

	else{
		$jeux = Jeux::all();
	}

	
	return $this->renderer->render($response, 'nom_jeux_page1.phtml', ["jeux" => $jeux]);

});

$app->post('/fiche_jeu', function (Request $request, Response $response, array $args){

	$this->db;

	$jeux = Jeux::where('id','=',$request->getParam('id'))->get();
	
	return $this->renderer->render($response, 'fiche_jeu.phtml', ["jeux" => $jeux]);

});

$app->post('/verif_acheter_jeu', function (Request $request, Response $response, array $args){

	$this->db;

	$jeux = Jeux::where('id','=',$request->getParam('id'))->first();

	$jeux->Vente = 1;
	
	$jeux->Panier = 0;

	$jeux->save();
	
	return $this->renderer->render($response, 'verif_acheter_jeu.phtml', ["jeux" => $jeux]);

});

$app->post('/verif_supp_panier_jeu', function (Request $request, Response $response, array $args){

	$this->db;

	$jeux = Jeux::where('id','=',$request->getParam('id'))->first();
	
	$jeux->Panier = 0;

	$jeux->save();

	return $this->renderer->render($response, 'verif_supp_panier_jeu.phtml', ["jeux" => $jeux]);

});

$app->get('/accueil', function (Request $request, Response $response, array $args){
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'accueil.phtml', $args);
});

$app->get('/', function (Request $request, Response $response, array $args){
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'accueil.phtml', $args);
});
