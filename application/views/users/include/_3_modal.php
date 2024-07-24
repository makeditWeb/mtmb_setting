<div class="modal write-modal view-modal" id="modal-alert" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-alert-title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modal-alert-title"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal-alert-content"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark white-font" id="modal-alert-agree">확인</button>
      </div>
    </div>
  </div>
</div>

<div class="modal write-modal view-modal" id="modal-confirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-confirm-title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modal-confirm-title"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal-confirm-content"></div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-secondary" id="modal-confirm-cancel">취소</button>
        <button type="button" class="btn btn-skyblue" id="modal-confirm-agree">확인</button>
      </div>
    </div>
  </div>
</div>

<div class="modal write-modal view-modal" id="modal-password" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-password-title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modal-password-title">비밀번호를 입력하여 주십시오.</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="modal_body_area" id="password_form">
          <div class="input_area">
            <div class="input_group">
              <label>비밀번호</label>
              <input type="password" class="form-valid fv_empty" id="modal-password-input" maxlength="50">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-skyblue" id="modal-password-agree">확인</button>
      </div>
    </div>
  </div>
</div>