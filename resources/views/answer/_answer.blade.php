<answer :answer="{{ $answer }}" inline-template>
  <div class="media post">
    <vote :model="{{ $answer }}" name="answer"></vote>
    <div class="media-body">
      <form v-if="editing" @submit.prevent="update">
        <div class="form-group">
          <textarea v-model="body" rows="10" class="form-control" required></textarea>
        </div>
        <button class="btn btn-outline-primary" :disabled="isInvalid">Update</button>
        <button class="btn btn-outline-danger"  @click="cancel" type="button">Cancel</button>
      </form>
      <div v-else>
          <div v-html="bodyHtml"></div>
          <div class="row">
            <div class="col-4">
              <div class="ml-auto ">
                @can('update', $answer)
                  <a @click.prevent="edit" class="btn btn-sm btn-outline-info my-2">{{ __('Edit') }}</a>
                @endcan
                @can('delete', $answer)
                <button @click="destroy" class="btn btn-sm btn-outline-danger">{{ __('Delete') }}</button>
                @endcan
              </div>
            </div>
            <div class="col-4">

            </div>
            <div class="col-4">
              <user-info :model="{{ $answer }}" label="Answered"></user-info>
            </div>
          </div>
      </div>
    </div>
  </div>

</answer>
