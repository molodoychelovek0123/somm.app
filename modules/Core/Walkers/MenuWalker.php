<?php

namespace Modules\Core\Walkers;
class MenuWalker {
    protected static $currentMenuItem;
    protected $menu;
    protected $activeItems = [];

    public function __construct( $menu ) {
        $this->menu = $menu;
    }

    public function generate() {
        $items = json_decode( $this->menu->items, true );
        if ( ! empty( $items ) ) {
            echo '<ul class="main-menu menu-generated">';
            $this->generateTree( $items );
            echo "<li class=\" depth-0 products-item\">
                      <div class=\"sommProductsBtn\"> OUR PRODUCTS </div>
                      <div class=\"sommProductsModal\">
                        <div class=\"textcontainer\">
                          <h3>Developing Somm, develop culture</h3>
                          <p>We put our soul into our projects to bring the experience to you</p></div>
                        <div class=\"itemscontainer\">
                          <a class=\"sommProductsLink\" href=\"https://sommtable.com\">
                            <div class=\"sommProductItem\">
                              <div class=\"product-image\">
                                <img src=\"/images/logos/sommtable.com.png\" class=\"img-responsive\" alt=\"Sommtable.com logo\">
                              </div>
                              <h4>Sommtable.com</h4>
                              <span>Our main product. Here you can find the store and SommBlog.</span>
                            </div>
                          </a>
                          <a class=\"sommProductsLink\" href=\"https://sommtable.pro\">
                            <div class=\"sommProductItem\">
                              <div class=\"product-image\">
                                <img src=\"/images/logos/sommtable.pro.png\" class=\"img-responsive\" alt=\"Sommtable.pro logo\">
                              </div>
                              <h4>Sommtable.pro</h4>
                              <span>Find your expert. Information about all experience experts.</span>
                            </div>
                          </a>
                          <a class=\"sommProductsLink\" href=\"https://sommtableimports.com\">
                            <div class=\"sommProductItem\">
                              <div class=\"product-image\">
                                <img src=\"/images/logos/sommtableimports.png\" class=\"img-responsive\" alt=\"Sommtableimports.com logo\">
                              </div>
                              <h4>Sommtableimports.com</h4>
                              <span>Import wines. Get the best experience even if you are not in the USA.</span>
                            </div>
                          </a>
                          <a class=\"sommProductsLink\" href=\"https://vinely.com\">
                            <div class=\"sommProductItem\">
                              <div class=\"product-image\">
                                <img src=\"/images/logos/vinely.gif\" class=\"img-responsive\" alt=\"vinely.com logo\">
                              </div>
                              <h4>Vinely.com</h4>
                              <span>Our video magazine. Experience from one video.</span>
                            </div>
                          </a>
                        </div>
                      </div>
                    </li>
                        ";

            echo '</ul>';
        }
    }

    public function generateTree( $items = [], $depth = 0, $parentKey = '' ) {

        foreach ( $items as $k => $item ) {

            $class          = e( $item['class'] ?? '' );
            $url            = $item['url'] ?? '';
            $item['target'] = $item['target'] ?? '';
            if ( ! isset( $item['item_model'] ) ) {
                continue;
            }
            if ( class_exists( $item['item_model'] ) ) {
                $itemClass = $item['item_model'];
                $itemObj   = $itemClass::find( $item['id'] );
                if ( empty( $itemObj ) ) {
                    continue;
                }
                $url = $itemObj->getDetailUrl();
            }
            if ( $this->checkCurrentMenu( $item, $url ) ) {
                $class               .= ' active';
                $this->activeItems[] = $parentKey;
            }

            if ( ! empty( $item['children'] ) ) {
                ob_start();
                $this->generateTree( $item['children'], $depth + 1, $parentKey . '_' . $k );
                $html = ob_get_clean();
                if ( in_array( $parentKey . '_' . $k, $this->activeItems ) ) {
                    $class .= ' active ';
                }
            }
            $class .= ' depth-' . ( $depth );
            printf( '<li class="%s">', $class );
            if ( ! empty( $item['children'] ) ) {
                $item['name'] .= ' <i class="caret fa fa-angle-down"></i>';
            }
            printf( '<a  target="%s" href="%s" >%s</a>', e( $item['target'] ), e( $url ), clean( $item['name'] ) );
            if ( ! empty( $item['children'] ) ) {
                echo '<ul class="children-menu menu-dropdown">';
                echo $html;
                echo "</ul>";
            }
            echo '</li>';
        }
    }

    protected function checkCurrentMenu( $item, $url = '' ) {

        if ( trim( $url, '/' ) == request()->path() ) {
            return true;
        }
        if ( ! static::$currentMenuItem ) {
            return false;
        }
        if ( empty( $item['item_model'] ) ) {
            return false;
        }
        if ( is_string( static::$currentMenuItem ) and ( $url == static::$currentMenuItem or $url == url( static::$currentMenuItem ) ) ) {
            return true;
        }
        if ( is_object( static::$currentMenuItem ) and get_class( static::$currentMenuItem ) == $item['item_model'] && static::$currentMenuItem->id == $item['id'] ) {
            return true;
        }

        return false;
    }

    public static function setCurrentMenuItem( $item ) {
        static::$currentMenuItem = $item;
    }

    public static function getActiveMenu() {
        return static::$currentMenuItem;
    }
}
