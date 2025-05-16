<div class="row">
    <x-admin.stat-card class="box1" title="Total Admins" count="{{ Number::format($this->totalAdmins) }}"
        icon="fa-solid fa-user-tie" />

        <x-admin.stat-card class="box2" title="Total Chefs" count="{{ Number::format($this->totalChefs) }}"
            icon="fa-solid fa-user" />

            <x-admin.stat-card class="box3" title="Total Items" count="{{ Number::format($this->totalItems) }}"
                icon="fa-solid fa-bowl-food" />
                <x-admin.stat-card class="box4" title="Total Orders" count="{{ Number::format($this->totalOrders) }}"
                    icon="fa-solid fa-bag-shopping" />

</div>
