<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class FeedShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('feed', function(ShortcodeInterface $sc) {
            $items = $this->grav['twig']->twig_vars['twig_feeds'][$sc->getContent()]['items'];
            $output = "";
            foreach($items as $item) {
                $images = array_filter($item['medias'] ?? [], function($media) { return str_contains($media['type'], 'image'); } );
                $output .= "<a class='feed-item' href='".$item['link']."'>";
                if (count($images) > 0) {
                    $image = array_pop($images);
                    $output .= "<img src='{$image['url']}' alt='{$image['title']}' class='feed-img'></img>";
                }
                $output .= "<div class='feed-content'>";
                $output .= "<h3>".$item['title']."</h3>";
                $output .= "<span>" . $item['lastModified'] . "</span>";
                $output .= "</div>";
                $output .= "</a>";
            }
            return $output;
        });
    }
}