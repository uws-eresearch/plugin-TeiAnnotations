<?php

class TeiAnnotationsPlugin extends Omeka_Plugin_AbstractPlugin
{
    protected $_hooks = array(
         'public_items_show',
            );
 
    public function hookPublicItemsShow($request)
    {
        echo "<hr /><h1>Footnotes</h1>";
         $item = get_current_record('item');
	//$objectRelations = ItemRelationsPlugin::prepareObjectRelations($item);
        //foreach ($objectRelations as $obj) {
        //   print_r( $obj);
      //}

        $objects = get_db()->getTable('ItemRelationsRelation')->findByObjectItemId($item->id);
        $objectRelations = array();
        foreach ($objects as $object) {
            //TODO: Look for annotation relation
            if (!($item = get_record_by_id('item', $object->subject_item_id))) {
                continue;
            }
	   echo "<div class='annotation'>";
	   echo "<h2>" .  metadata($item, array('Dublin Core', 'Title')).  "</h2>";
           echo "<p>" . metadata($item, array('Dublin Core', 'Description')) . "</p>";
           echo "</div>";
	}
	//print_r($objectRelations);
}
}
