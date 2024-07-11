<!-- s: 레퍼런스 -->
<section class="container ref">
    <!-- <h1>레퍼런스</h1> -->
    <div class="row">
        <?php
        foreach ($reference_list as $list) {
            $img = json_decode($list->img_name)[0];
        ?>
            <div class="col-6 col-lg-3 select_reference" data-curridx="<?= $list->idx ?>" style="padding:5px;">
                <p><?= $list->title ?></p>
                <img src="<?= $img ?>" alt="<?= $list->title ?>">
            </div>
        <?php } ?>
    </div>
</section>
<!-- e: 레퍼런스 -->

</section>

<!-- s:게시글 조회 모달 -->
<div class="modal fade write-modal view-modal" id="modal-reference-view" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="reviewModalLabel">레퍼런스</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal_review">
                    <h5 id="modal-reference-view-title"></h5>
                </div>
                <div class="modal_review_text row" id="modal-reference-view-img"></div>
            </div>
        </div>
    </div>
</div>

<script>
    let curr_reference_idx;
    let modal_reference_view;

    $(function() {
        $(".select_reference").on("click", function() {
            curr_reference_idx = $(this).data('curridx');
            view_reference();
        });

        modal_reference_view = new bootstrap.Modal(document.getElementById("modal-reference-view"), {
            keyboard: false,
        });
    });



    function view_reference() {
        $.post("/business/referenceView", {
            idx: curr_reference_idx
        }, function(data) {
            var result = JSON.parse(data);
            if (result.flag) {
                modal_reference_view.show();
                var img_list = JSON.parse(result.data.img_name);
                $("#modal-reference-view-title").text(result.data.title);
                $("#modal-reference-view-img").empty();

                $.each(img_list, function(key, value) {
                    div_tags = $("<div/>", {
                        class: 'col-lg-6 col-sm-12 mb-2 text-center'
                    });
                    img_tags = $("<img/>", {
                        class: 'w100per',
                        src: value
                    });
                    div_tags.append(img_tags);
                    $("#modal-reference-view-img").append(div_tags);
                });
            }
        });
    }
</script>