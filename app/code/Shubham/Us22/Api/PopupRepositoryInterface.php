<?php
namespace Shubham\Us22\Api;

use Shubham\Us22\Api\Data\PopupInterface;

interface PopupRepositoryInterface
{
    /**
     * @param PopupInterface $popup
     * @return void
     */
   public function save(PopupInterface $popup): void;

   /**
    * @param int $popupId
    * @return PopupInterface
    */
   public function getById(int $popupId): PopupInterface ;

    /**
     * @param PopupInterface $popup
     * @return void
     */
   public function delete(PopupInterface $popup): void;

}
