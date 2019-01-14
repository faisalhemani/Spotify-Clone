<?php
	class Track {
		private $con;
		private $id;
		private $masoom;
		private $mysqliData;
		private $title;
		private $artistId;
		private $type;
		private $duration;
		private $path;
		private $textPath;

		public function __construct($con, $typeId) {
			$this->con = $con;
			$this->id = $typeId;;

			$query = mysqli_query($this->con, "SELECT * FROM tracks WHERE ID='$this->id'");
			$this->mysqliData = mysqli_fetch_array($query);
			$this->title = $this->mysqliData['title'];
			$this->artist = $this->mysqliData['artist'];
			$this->type = $this->mysqliData['type'];
			$this->duration = $this->mysqliData['duration'];
			$this->path = $this->mysqliData['path'];
			$this->textPath = $this->mysqliData['textPath'];
		}

		public function getTitle() {
			return $this->title;
		}

		public function getId() {
			return $this->id;
		}

		public function getArtist() {
			$artistQuery = mysqli_query($this->con, "SELECT name FROM artist WHERE ID='$this->artist'");
			$artistName = mysqli_fetch_array($artistQuery);
			return $artistName['name'];
		}
		public function getType() {
			$typeQuery = mysqli_query($this-con, "SELECT name FROM type WHERE ID='$this->type'");
			$typeName = mysqli_fetch_array($typeQuery);
			return $typeName;
		}
		public function getDuration() {
			return $this->duration;
		}
		public function getPath() {
			return $this->path;
		}
		public function getTextPath() {
			return $this->textPath;
		}
	}
?>