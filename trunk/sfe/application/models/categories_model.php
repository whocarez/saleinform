<?php
class Categories_model extends Model{
	public function GetCategories($categoriesRID=null){
			$this->db->where(array('_categories._categories_rid'=>$categoriesRID, '_categories.archive'=>'0'));
		}
	public function getCategoryInfo($categoriesRID){
	public function GetCategoryImages($categoriesRID, $imageTYPE = null){


	public function GetItemImages($itemsRID){
		$itemimgsArr = explode('|', $itemsRID);

	public function GetOffersByCategory($cRid){
		$c = $this->getCategoryInfo($cRid);
		$this->db->limit(15, $page);
		$query = $this->db->get();

	public function GetCategoryPriceTypes($catRID){

	public function setSearchStat($str){

	/**
	* @author Mazvv
	* @param string $searchSTR
	* @return array $words
	*/
	public function GetSearchExpression($searchSTR){
		$searchARR = array();

	/**
	 * @author Mazvv
	 * @param void
	 * @return integer $rowsQuan
	 */
	public function GetQueryRowsQuan(){
		$this->db->select('FOUND_ROWS() as rowsQuan');
		$query = $this->db->get();
		return $query->row()->rowsQuan;
	}

	public function getTopCategories($limit=15){
	public function getMainSecondLevelCategories($catRid){
	public function getSecondLevelCategories(){