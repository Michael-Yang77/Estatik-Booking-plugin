<?php
    $location = get_field( 'bcf_address' );
?> 

<div class="bcf_box">
    <p class="meta-options bcf_field">
        <label for="bcf_start_date">Start_date</label>
        <input id="bcf_start_date"
            type="text"
            name="bcf_start_date"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'bcf_start_date', true ) ); ?>">
    </p>
    <p class="meta-options bcf_field">
        <label for="bcf_end_date">End_Date</label>
        <input id="bcf_end_date"
            type="date"
            name="bcf_end_date"
           value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'bcf_end_date', true ) ); ?>">
    </p>
    <p class="meta-options bcf_field">
        <label for="bcf_address">Address</label>
        <input id="bcf_address"
            type="number"
            name="bcf_address"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'bcf_address', true ) ); ?>">
    </p>
    <div class="bcf-map">
        <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
    </div>
</div>