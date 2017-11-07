<?php 
	use Illuminate\Database\Eloquent\Model as Eloquent;

	class Jeux extends Eloquent {
		
		protected $table = 'jeux';
		
		protected $id = ['id'];
		protected $Nom = ['Nom'];
		protected $Categorie = ['Categorie'];
		protected $Editeur = ['Editeur'];
		protected $Image = ['Image'];
		protected $Date = ['Date'];
		protected $Note = ['Note'];
		protected $Prix = ['Prix'];
		protected $PS4 = ['PS4'];
		protected $XBOX_ONE = ['XBOX_ONE'];
		protected $SWITCH = ['SWITCH'];
		protected $PC = ['PC'];
		protected $PS3 = ['PS3'];
		protected $XBOX_360 = ['XBOX_360'];
		protected $Vente = ['Vente'];
		protected $Panier = ['Panier'];

		public $timestamps = false;


	}