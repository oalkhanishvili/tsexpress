<?php if(!defined())
class Hello extends CI_Controller{
	public class __construct(){
		parent::__construct();
		echo "This is initization";
	}
	public function index(){
		echo "This is my index function";
	}
	public function one($p1, $p2){
		echo "This is one<br>";
		echo "This are Params {$p1}{$p2}";
	}
	public function two(){
		echo "This is two";
	}
}