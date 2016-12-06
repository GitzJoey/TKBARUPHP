<?php
/**
 * Created by PhpStorm.
 * User: MILIMURIDAM
 * Date: 12/3/2016
 * Time: 6:47 PM
 */

namespace App\Services;


use App\Model\PurchaseOrderCopy;
use Doctrine\Common\Collections\Collection;
use Illuminate\Http\Request;

interface PurchaseOrderCopyService
{
    /**
     * Get all copies of purchase order with given code.
     *
     * @param string $poCode code of purchase order.
     * @return Collection copies of purchase order.
     */
    public function getCopiesOfPO($poCode);

    /**
     * Create a copy of purchase order. Created copy will be returned.
     *
     * @param Request $request request containing data for creating the copy of purchase order.
     * @param string $poCode code of purchase order to be copied.
     * @return PurchaseOrderCopy copy of purchase order.
     */
    public function createPOCopy(Request $request, $poCode);

    /**
     * Get a copy of purchase order to be edited.
     *
     * @param int $id id of copy of purchase order.
     * @return PurchaseOrderCopy
     */
    public function getPOCopyForEdit($id);

    /**
     * Edit a copy of purchase order. Edited copy of purchase order will be returned.
     *
     * @param Request $request request that contains values from edit form.
     * @param int $poCopyId id of copy of purchase order.
     * @return PurchaseOrderCopy
     */
    public function editPOCopy(Request $request, $poCopyId);
}