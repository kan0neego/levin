<?php

class Footer_Primary_Menu_Walker extends Walker_Nav_Menu {
    
    public function start_lvl(&$output, $depth = 0, $args = null) {}
    public function end_lvl(&$output, $depth = 0, $args = null) {}

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $has_children = in_array('menu-item-has-children', $classes);
        $url = esc_url($item->url);
        $title = apply_filters('the_title', $item->title, $item->ID);

        if ($depth == 0) {
            $output .= '<div class="footer-block__col">';

            if ($item->url == "#" || empty($item->url)) {
                $output .= '<span class="footer-block__name">' . $title . '</span>';
            } else {
                $output .= '<a href="' . $url . '" class="footer-block__name">' . $title . '</a>';
            }

            if ($has_children) {
                $output .= '<ul class="footer-block__menu">';
            }

        } elseif ($depth == 1) {
            
            $output .= '<li class="footer-block__item">';
            $output .= '<a href="' . $url . '" class="footer-block__link">' . $title . '</a>';
            // Не закрываем </li> здесь, если хотим следовать структуре Walker
        
        }
    }

    public function end_el(&$output, $item, $depth = 0, $args = null) {
        
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $has_children = in_array('menu-item-has-children', $classes);

        if ($depth == 0) {
            if ($has_children) {
                $output .= '</ul>'; 
            }
            $output .= '</div>';
        } elseif ($depth == 1) {
            $output .= '</li>';
        }
    }
}