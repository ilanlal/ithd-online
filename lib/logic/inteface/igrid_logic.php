<?php

interface iGrid_Logic {
	public function get_dynamic($cols,$where = NULL, $order_by = NULL, $row_limit = NULL);
    public function delete($item_id);
    public function update($item);
}
