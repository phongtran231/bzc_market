<?php

namespace Modules\Backend\Services\ShopOwner;

use App\Models\ShopOwner;
use Illuminate\Support\Facades\Request;

interface ShopOwnerServiceInterface
{
    /**
     * @return ShopOwner
     */
    public function getInfo();

    /**
     * @param Request $attrs
     * @return void
     */
    public function update(Request $attrs);

    /**
     * @param Request $attrs
     * @return ShopOwner
     */
    public function save(Request $attrs);

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id);

}
