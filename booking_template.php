
<div class="bcf-content">
    <ul>
        <li><strong>Start Date: </strong><?php echo esc_attr( get_post_meta( get_the_ID(), 'bcf_start_date', true ) ); ?></li>
        <li><strong>End Date: </strong><?php echo esc_attr( get_post_meta( get_the_ID(), 'bcf_end_date', true ) ); ?></li>
        <li><strong>Address: </strong><?php echo esc_attr( get_post_meta( get_the_ID(), 'bcf_address', true ) ); ?></li>
    </ul>
</div>
