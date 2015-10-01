<?php
  //Get all posts of type slider for carousel
  $args = array(
        'post_type' => 'slider',
        'post_status' => 'publish',
        'order'   => 'ASC',
      );
  $slider_query = new WP_Query( $args );
  $slides_arr = array();

  while( $slider_query->have_posts() ) {
        $slider_query->the_post();

        $slide['title'] = get_the_title();
        $slide['excerpt'] = get_the_excerpt();
        $slide['image'] = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
        $linkto = get_post_custom_values('linkto', $post->ID);
        $slide['linkto'] = (is_array($linkto)) ? $linkto[0] : get_the_permalink() ;
        $btntext = get_post_custom_values('btntext', $post->ID);
        $slide['btntext'] = (is_array($linkto)) ? $btntext[0] : 'Leer Más' ;
        array_push($slides_arr, $slide);
  }
  wp_reset_query();
?>      
<div id="folat-home-carousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <?php for($i = 0; $i < count($slides_arr); $i++):?>
          <li data-target="#folat-home-carousel" data-slide-to="<?= $i;?>" <?php if($i==0) echo 'class="active"';?>></li>
    <?php endfor;?>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <?php for($i = 0; $i < count($slides_arr); $i++):?>
      <div class="item <?php if($i == 0) echo 'active';?>" style="background-image:url(<?= $slides_arr[$i]['image'];?>);">
        <div class="carousel-caption">
          <div class="title"><?php echo $slides_arr[$i]['title'];?></div>
          <div class="content"><?php echo $slides_arr[$i]['excerpt'];?></div>
          <a href="<?php echo $slides_arr[$i]['linkto'];?>" class="btn btn-default btn-lg"><?php echo $slides_arr[$i]['btntext'];?></a>
        </div>
      </div>
    <?php endfor;?>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#folat-home-carousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#folat-home-carousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


<div class="jumbotron">
  <h2>¿Qué es FOLAT?</h2>
  <p><?php the_content();?></p>
  <div class="text-center">
    <p><a class="btn btn-primary btn-large">Inscríbase Hoy!</a></p>
  </div>
</div>

<div class="row featured-headings">
  <?php if ( is_active_sidebar( 'home_featured' ) ) : ?>
    <div class="primary-sidebar widget-area" role="complementary">
      <?php dynamic_sidebar( 'home_featured' ); ?>
    </div>
  <?php endif; ?>
</div>