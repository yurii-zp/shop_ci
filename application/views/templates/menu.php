<ul>
    <li class="<?php echo current_url() == base_url('catalog/index') ? 'current' : ''; ?>">
        <a href="<?php echo site_url('catalog/index'); ?>">Catalog</a>
    </li>
    <?php if(isset($this->session->regadmin)) : ?>
        <li class="<?php echo current_url() == base_url('archive/index') ? 'current' : ''; ?>">
            <a href="<?php echo site_url('archive/index'); ?>">Archive</a>
        </li>
        <li class="<?php echo current_url() == base_url('admin/index') ? 'current' : ''; ?>">
            <a href="<?php echo site_url('admin/index'); ?>">Admin Area</a>
        </li>
    <?php endif; ?>
</ul>