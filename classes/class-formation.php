<?php

class Formation implements JsonSerializable
{
    private $idFormation        = 0;
    private $nomFormation       = null;
    private $objFormation       = null;
    private $objProFormation    = null;
    private $parcoursPedaPrevi  = null;

    // --- OPERATIONS ---
    public function __construct($idFormation=0, $nomFormation=null, $objFormation =null, $objProFormation =null, $parcoursPedaPrevi =null){
		$this->idFormation 	      = $idFormation;
		$this->nomFormation 	    = $nomFormation;
		$this->objFormation       = $objFormation;
		$this->objProFormation    = $objProFormation;
		$this->parcoursPedaPrevi  = $parcoursPedaPrevi;
    }
    public function getIdFormation(){return $this->idFormation;}
    public function getNomFormation(){return $this->nomFormation;}
    public function getObjFormation(){return $this->objFormation;}
    public function getObjProFormation(){return $this->objProFormation;}
    public function getParcoursPedaPrevi(){return $this->parcoursPedaPrevi;}

    public function setIdFormation($idFormation){$this->idFormation=$idFormation;}
    public function setNomFormation($nomFormation){$this->nomFormation=$nomFormation;}
    public function setObjFormation($objFormation){$this->objFormation=$objFormation;}
    public function setObjProFormation($objProFormation){$this->objProFormation=$objProFormation;}
    public function setParcoursPedaPrevi($parcoursPedaPrevi){$this->parcoursPedaPrevi=$parcoursPedaPrevi;}
    
     public function jsonSerialize(){ return get_object_vars($this); }
} 
?>
