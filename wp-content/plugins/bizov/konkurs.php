<?php

bizov_input(array(
    'label'     => __('Thumbnail', 'bizov'),
    'id'        => 'thumbnail',
    'type'      => 'image',
    'multiple'  => 0,
    'required'  => 0
));

?>

<?php
bizov_input(array(
    'label'     => __('Konkurs Gallery', 'bizov'),
    'id'        => 'konkurs_slider',
    'type'      => 'image',
    'multiple'  => 1,
    'required'  => 0
));