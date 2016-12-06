<?php
/**
 * Created by PhpStorm.
 * User: MILIMURIDAM
 * Date: 12/5/2016
 * Time: 9:47 PM
 */

namespace App\Services;


use App\Model\SalesOrderCopy;
use Doctrine\Common\Collections\Collection;
use Illuminate\Http\Request;

interface SalesOrderCopyService
{
    /**
     * Get all copies of sales order with given code.
     *
     * @param string $soCode code of sales order.
     * @return Collection copies of sales order.
     */
    public function getCopiesOfSO($soCode);

    /**
     * Create a copy of sales order. Created copy will be returned.
     *
     * @param Request $request request containing data for creating the copy of sales order.
     * @param string $soCode code of sales order to be copied.
     * @return SalesOrderCopy copy of sales order.
     */
    public function createSOCopy(Request $request, $soCode);

    /**
     * Get a copy of sales order to be edited.
     *
     * @param int $id id of copy of sales order.
     * @return SalesOrderCopy
     */
    public function getSOCopyForEdit($id);

    /**
     * Edit a copy of sales order. Edited copy of sales order will be returned.
     *
     * @param Request $request request that contains values from edit form.
     * @param int $soCopyId id of copy of sales order.
     * @return SalesOrderCopy
     */
    public function editSOCopy(Request $request, $soCopyId);
}