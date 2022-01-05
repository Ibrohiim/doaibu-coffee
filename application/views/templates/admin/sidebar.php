<?php
$site = $this->configuration_model->getConfig();
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= base_url('homepage') ?>" class="brand-link">
        <img src="<?= base_url('assets/'); ?>img/configuration/<?= $site['icon'] ?>" alt="Doi Icon" class="brand-image img-circle elevation-3">
        <img src="<?= base_url('assets/'); ?>img/configuration/<?= $site['logo'] ?>" alt="Doi Logo" class="brand-text" width="60%">
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('assets/'); ?>img/profile/<?= $user['image'] ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $user['name'] ?></a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-compact" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">MAIN NAVIGATION</li>

                <?php

                $role_id = $this->session->userdata('role_id');
                $queryMenu = "SELECT `sidebar_menu`. `id`, `menu`, `icon`, `submenu`, `url_menu`, `sorting`
                            FROM `sidebar_menu` JOIN `user_access_menu`
                            ON `sidebar_menu`.`id` = `user_access_menu`. `menu_id`
                            WHERE `user_access_menu`.`role_id` = $role_id
                            ORDER BY `sorting`, `user_access_menu`.`menu_id` ASC
                            ";
                $menu = $this->db->query($queryMenu)->result_array();
                ?>
                <?php foreach ($menu as $m) :

                    $menuId = $m['id'];
                    $querySubMenu = "SELECT *, sidebar_submenu.icon AS submenu_icon
                            FROM `sidebar_submenu` JOIN `sidebar_menu`
                            ON `sidebar_submenu`.`menu_id` = `sidebar_menu`. `id`
                            WHERE `sidebar_submenu`.`menu_id` = $menuId
                            AND `sidebar_submenu`.`is_active` = 1
                            ";
                    $subMenu = $this->db->query($querySubMenu)->result_array();
                ?>
                    <?php if ($m['submenu'] == 'NO') { ?>
                        <li class="nav-item">
                            <a href="<?= base_url($m['url_menu']) ?>" class="nav-link <?= $m['menu'] == $title ? 'active' : null ?>">
                                <i class="nav-icon <?= $m['icon']; ?>"></i>
                                <p><?= $m['menu']; ?></p>
                            </a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item <?php foreach ($subMenu as $sm) :
                                                if ($title == $sm['title']) {
                                                    echo 'menu-open';
                                                } ?>
                                        <?php endforeach; ?>">
                            <a href="#" class="nav-link <?php foreach ($subMenu as $sm) :
                                                            if ($title == $sm['title']) {
                                                                echo 'active';
                                                            } ?>
                                        <?php endforeach; ?>">
                                <i class="nav-icon <?= $m['icon']; ?>"></i>
                                <p>
                                    <?= $m['menu']; ?>
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <?php foreach ($subMenu as $sm) : ?>
                                    <?php if ($title == $sm['title']) : ?>
                                        <li class="nav-item">
                                            <a href="<?= base_url($sm['url']); ?>" class="nav-link active">
                                            <?php else : ?>
                                        <li class="nav-item">
                                            <a href="<?= base_url($sm['url']); ?>" class="nav-link">
                                            <?php endif; ?>
                                            <i class="<?= $sm['submenu_icon']; ?>"></i>
                                            <p><?= $sm['title']; ?></p>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php } ?>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>
</aside>