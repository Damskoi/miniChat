<?php
	class Model {

		private $bdd;
		private static $instance= NULL;

		private function __construct(){
			try {
				$this->bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
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

//				SELECT TIMEDIFF(CURRENT_TIMESTAMP, whenn) as ya FROM `online` WHERE pseudo='dams'
//				SELECT TIME_FORMAT( TIMEDIFF(CURRENT_TIMESTAMP, whenn), "%imin%ss") as ya FROM `online` WHERE pseudo='dams'
		public function get_listeOnlineSauf($pseudo){
			$sql = 'SELECT DISTINCT *, TIME_FORMAT( TIMEDIFF(CURRENT_TIMESTAMP, whenn), "%imin%ss") as ya from online WHERE whenn > DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 10 MINUTE) AND NOT pseudo= :pseudo';
			try{
				$req = $this->bdd->prepare($sql);
				$req->execute(array(
					':pseudo' => htmlspecialchars($pseudo)
				));
				$res = $req->fetchAll(PDO::FETCH_ASSOC);
				$req->closeCursor();
			} 
			catch(PDOException $e){
				echo '<p> Requete liste des membres online Failed '. $e->getCode().', '. $e->getMessage() .'</p>';
			}
			return $res;
		}
		
		public function action($pseudo){
			$sql = 'INSERT INTO online(pseudo) VALUES(:pseudo) ';
			try{
				$req = $this->bdd->prepare($sql);
				$req->execute(array(
					':pseudo' => htmlspecialchars($pseudo),
				));	
			} 
			catch(PDOException $e){
				echo '<p> Requete action Failed '. $e->getCode().', '. $e->getMessage() .'</p>';
			}
			return $req;
		}

		public function estConnecter($pseudo){
			$sql = 'SELECT DISTINCT * from online where pseudo= :pseudo ';
			try{
				$req = $this->bdd->prepare($sql);
				$req->execute(array(
					':pseudo' => htmlspecialchars($pseudo),
				));
				$res = $req->fetchAll(PDO::FETCH_ASSOC);
				$req->closeCursor();
			} 
			catch(PDOException $e){
				echo '<p> Requete estOnline Failed '. $e->getCode().', '. $e->getMessage() .'</p>';
			}
			return $res;
		}

		public function reaction($pseudo){
			$sql = 'UPDATE online SET whenn= CURRENT_TIMESTAMP where pseudo= :pseudo ';
			try{
				$req = $this->bdd->prepare($sql);
				$req->execute(array(
					':pseudo' => htmlspecialchars($pseudo),
				));	
			} 
			catch(PDOException $e){
				echo '<p> Requete reaction Failed '. $e->getCode().', '. $e->getMessage() .'</p>';
			}
			return $req;
		}

		public function deconnection($pseudo){
			$sql = 'UPDATE online SET whenn= DATE_SUB(whenn, INTERVAL 15 MINUTE) where pseudo= :pseudo ';
			try{
				$req = $this->bdd->prepare($sql);
				$req->execute(array(
					':pseudo' => htmlspecialchars($pseudo),
				));	
			} 
			catch(PDOException $e){
				echo '<p> Requete deconnection Failed '. $e->getCode().', '. $e->getMessage() .'</p>';
			}
			return $req;
		}		
		
		
		public function cleanupOnline(){
			$sql = 'DELETE FROM online WHERE whenn < DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 1 MONTH)';
			try{
				$req = $this->bdd->prepare($sql);
				$req->execute();	
			} 
			catch(PDOException $e){
				echo '<p> Requete cleanupOnline Failed '. $e->getCode().', '. $e->getMessage() .'</p>';
			}
			return $req;
		}

		public function get_listeConvoDe($pseudo){
			$sql = 'SELECT DISTINCT dest from chat where expe= :pseudo ';
			try{
				$req = $this->bdd->prepare($sql);
				$req->execute(array(
					':pseudo' => htmlspecialchars($pseudo),
				));
				$res = $req->fetchAll(PDO::FETCH_ASSOC);
				$req->closeCursor();
			} 
			catch(PDOException $e){
				echo '<p> Requete liste des convo Failed '. $e->getCode().', '. $e->getMessage() .'</p>';
			}
			return $res;
		}

		public function getMessage($pers1, $pers2){
			$sql = 'SELECT expe, msg, DATE_FORMAT(date_time, "le %d/%m/%Y à %Hh%imin%ss") AS date FROM chat
					WHERE expe= :pers1 AND dest= :pers2 OR expe= :pers2 AND dest= :pers1
					ORDER BY date_time DESC /**/ LIMIT 10';
			try{
				$req = $this->bdd->prepare($sql);
				$req->execute(array(
					':pers1' => htmlspecialchars($pers1),
					':pers2' => htmlspecialchars($pers2)
				));
				$res = $req->fetchAll(PDO::FETCH_ASSOC);
				$req->closeCursor();
			} 
			catch(PDOException $e){
				echo '<p> Requete getMessage Failed '. $e->getCode().', '. $e->getMessage() .'</p>';
			}
			return $res;
		}

		public function getMessageTest($pers1, $pers2, $inf=0){
			$sql = 'SELECT expe, msg, DATE_FORMAT(date_time, "le %d/%m/%Y à %Hh%imin%ss") AS date FROM chat
					WHERE expe= :pers1 AND dest= :pers2 OR expe= :pers2 AND dest= :pers1
					ORDER BY date_time DESC limit '. $inf*10 .',10';
			try{
				$req = $this->bdd->prepare($sql);
				$req->execute(array(
					':pers1' => htmlspecialchars($pers1),
					':pers2' => htmlspecialchars($pers2)
				));
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

		public function insertMessage($expe, $dest, $msg){
			$sql= 'INSERT INTO chat(expe, dest, msg) VALUES( :expe, :dest, :msg)';
			try{
				$req = $this->bdd->prepare($sql);
				$req->execute(array(
					':expe' 	=> htmlspecialchars($expe),
					':dest' 	=> htmlspecialchars($dest),
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
				echo '<p> enregistrement requete Client failed'. $e->getMessage() . ' </p>';
			}
		}


		public function getMembresSauf($pseudo){
			$sql= 'SELECT pseudo FROM membres WHERE NOT pseudo = :pseudo';
			try{
				$req= $this->bdd->prepare($sql);
				$req->execute(array(
					':pseudo'	=> htmlspecialchars($pseudo)
				));
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