<?php
	class Model {

		private $bdd;
		private static $instance= NULL;

		private function __construct(){
			try {
				$this->bdd = new PDO('mysql:host=localhost;dbname=minichat_v1;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	//			echo '<h3> Connexion Reussi à la Base </h3>';
			}
			catch (Exception $e) {
		        die('<p> La connexion à echoué : '. $e->getCode() .', ' . $e->getMessage() .'</p>');
			}
		}

		public static function get_model(){
			if(is_null(self::$instance)) return new Model;
			return self:: $instance;
		}

		public function getMessage(){
			$sql = 'SELECT pseudo, msg, DATE_FORMAT(date_time, "le %d/%m/%Y à %Hh%imin%ss") AS date FROM chat ORDER BY date_time DESC';
			try{
				$req = $this->bdd->prepare($sql);
				$req->execute();
				$res = $req->fetchAll(PDO::FETCH_ASSOC);
				$req->closeCursor();
			} 
			catch(PDOException $e){
				echo '<p> Requete getMessage Failed '. $e->getCode().', '. $e->getMessage() .'</p>';
			}
			return $res;
		}

		public function getMessageBis($page){
			$sql = 'SELECT pseudo, msg, DATE_FORMAT(date_time, "le %d/%m/%Y à %Hh%imin%ss") AS date FROM chat ORDER BY date_time DESC LIMIT(
			10*'.$page.',10+'.$page.
		')';
			try{
				$req = $this->bdd->prepare($sql);
				$req->execute();
				$res = $req->fetchAll(PDO::FETCH_ASSOC);
				$req->closeCursor();
			} 
			catch(PDOException $e){
				echo '<p> Requete getMessage Failed '. $e->getCode().', '. $e->getMessage() .'</p>';
			}
			return $res;
		}

		public function get_nbMsg(){
			$sql = 'SELECT COUNT(msg) AS nbMsg from chat';
			try{
				$req = $this->bdd->prepare($sql);
				$req->execute();
				$res = $req->fetch(PDO::FETCH_ASSOC);
				$req->closeCursor();
			} 
			catch(PDOException $e){
				echo '<p> Requete get_nbMsg Failed '. $e->getCode().', '. $e->getMessage() .'</p>';
			}
			return $res['nbMsg'];
		}

		public function insertMessage($pseudo, $msg){
			$sql= 'INSERT INTO chat(pseudo, msg) VALUES( :pseudo, :msg)';
			try{
				$req = $this->bdd->prepare($sql);
				$req->execute(array(
					':pseudo' 	=> htmlspecialchars($pseudo),
					':msg' 		=> htmlspecialchars($msg)
				));	
			}
			catch(PDOException $e){
				echo '<p> Requete insertMessage Failed '. $e->getCode().', '. $e->getMessage() .'</p>';
			}
			return $req;
		}

		public function supprimerMessage($msg){
			$sql= 'DELETE FROM chat WHERE msg= :msg';
			try{
				$req = $this->bdd->prepare($sql);
				$req->execute(array(
					':pseudo' 	=> htmlspecialchars($pseudo),
					':msg' 		=> htmlspecialchars($msg)
				));	
			}
			catch(PDOException $e){
				echo '<p> Requete suppression Message Failed '. $e->getCode().', '. $e->getMessage() .'</p>';
			}
			return $req;
		}

		public function ajoutMembre($pseudo, $nom, $prenom, $pass, $email){
			$sql= 'INSERT INTO membres(pseudo, nom, prenom, passwd, email) VALUES(:pseudo, :nom, :prenom, :pass, :email)';
			try{
				$req = $this->bdd->prepare($sql);
				$req->execute(array(
					':pseudo' 	=> htmlspecialchars($pseudo),
					':nom'		=> htmlspecialchars($nom),
					':prenom'	=> htmlspecialchars($prenom),
					'pass'		=> htmlspecialchars($pass),
					':email' 	=> htmlspecialchars($email)
				));	
			}
			catch(PDOException $e){
				echo '<p> Requete ajoutMembre Failed '. $e->getCode().', '. $e->getMessage() .'</p>';
			}
			return $req;
		}

		public function existe($pseudo){
			$sql= 'SELECT id, passwd FROM membres WHERE pseudo = :pseudo';
			try{
				$req = $this->bdd->prepare($sql);
				$req->execute(array(
				    ':pseudo' => htmlspecialchars($pseudo)
				));
				$res = $req->fetch(PDO::FETCH_ASSOC);
				$req->closeCursor();
			}
			catch(PDOException $e){
				echo '<p> Requete de vérification Failed '. $e->getCode().', '. $e->getMessage() .'</p>';
			}
			return $res;
		}
		
		public function emailExiste($email){
			$sql= 'SELECT id, pseudo FROM membres WHERE email = :email';
			try{
				$req = $this->bdd->prepare($sql);
				$req->execute(array(
				    ':email' => htmlspecialchars($email)
				));
				$res = $req->fetch(PDO::FETCH_ASSOC);
				$req->closeCursor();
			}
			catch(PDOException $e){
				echo '<p> Requete existance email Failed '. $e->getCode().', '. $e->getMessage() .'</p>';
			}
			return $res;
		}

		public function requeteClient($id, $pseudo, $obj){
			$sql= 'INSERT INTO requeteClient(id, pseudo, objet) VALUES(:id, :pseudo, :obj)';
			try{
				$req= $this->bdd->prepare($sql);
				$req->execute(array(
					':id'		=> htmlspecialchars($id),
					':pseudo'	=> htmlspecialchars($pseudo),
					':obj'		=> htmlspecialchars($obj),
				));
				return $req;
			}
			catch(PDPException $e){
				echo '<p> requete Client failed'. $e->getMessage() . ' </p>';
			}
		}


		public function getMembres(){
			$sql= 'SELECT pseudo FROM membres WHERE NOT pseudo = "dams"';
			try{
				$req = $this->bdd->query($sql);
				$res = $req->fetchAll(PDO::FETCH_ASSOC);
				$req->closeCursor();
			}
			catch(PDOException $e){
				echo '<p> Requete getMembres Failed '. $e->getCode().', '. $e->getMessage() .'</p>';
			}
			return $res;
		}

	}
?>