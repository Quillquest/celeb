<div class="row">
    <div class="col-12">
        <form method="post" action="{{ route('updatewebinfo') }}" id="appinfoform" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class=" form-row">
                <div class="form-group col-md-6">
                    <h5 class="text-{{ $text }}">Website Name</h5>
                    <input type="text" name="site_name" class="form-control " value="{{ $settings->site_name }}"
                        required>
                </div>
                <div class="form-group col-md-6">
                    <h5 class="text-{{ $text }}">Website Title</h5>
                    <input type="text" name="site_title" class="form-control " value="{{ $settings->site_title }}"
                        required>
                </div>

                <div class="form-group col-md-6">
                    <h5 class="text-{{ $text }}">Website Url (https://yoursite.com)</h5>
                    <input type="text" placeholder="https://yoursite.com" name="site_address" class="form-control "
                        value="{{ $settings->site_address }}" required>
                </div>


                <div class="form-group col-md-6">
                    <h5 class="text-{{ $text }}">Office Address</h5>
                    <input type="text" placeholder="Office addresss" name="locations" class="form-control "
                        value="{{ $settings->locations }}">
                </div>

                {{-- <div class="form-group col-md-12">
                    <h5 class="text-{{ $text }}">Website Description</h5>
                    <textarea name="description" class="form-control " rows="4">{{ $settings->description }}</textarea>
                </div> --}}
            </div>

            <div class=" form-row">


                <div class="form-group col-md-6">
                    <h5 class="text-{{ $text }}">whatsapp number <span class='text-danger'>(*If You don't want
                            to use whatsapp leave it empty)</span></h5>
                    <input name="whatsapp" class="form-control " type="text" value="{{ $settings->whatsapp }}">
                </div>
                <div class="form-group col-md-6">
                    <h5 class="text-{{ $text }}">Tido livechat id <span class='text-danger'>(*If You don't want
                            to use Tido leave it empty)</span></h5>
                    <input name="tido" class="form-control " type="text" value="{{ $settings->tido }}">
                </div>
                <div class="form-group col-md-6">
                    <h5 class="text-{{ $text }}">Year strated</h5>
                    <input name="twak" class="form-control " type="text" value="{{ $settings->twak }}"
                        placeholder='Year site started'>
                </div>

                <!--<div class="form-group col-md-6">-->
                <!--    <h5 class="text-{{ $text }}">Personal Access Token</h5>-->
                <!--    <input name="merchant_key" class="form-control " type="text"-->
                <!--        value="{{ $settings->merchant_key }}">-->
                <!--</div>-->

                <div class="form-group col-md-6">

                    <div class="mt-4">
                        <h5 class="text-{{ $text }}">Installation Type</h5>
                        <select name="install_type" class="form-control ">
                            <option>{{ $settings->install_type }}</option>
                            <option>Main-Domain</option>
                            <option>Sub-Domain</option>
                            <option>Sub-Folder</option>
                        </select>
                    </div>

                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <h5 class="text-{{ $text }}">Logo (Recommended size; max width, 200px and max height
                        100px.)</h5>
                    <input name="logo" class="form-control " type="file">
                    <div class="text-center border p-2 mt-2 rounded-none">
                        <img src="{{ asset('storage/' . $settings->logo) }}" alt="" class="w-25 img-fluid">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <h5 class="text-{{ $text }}">Favicon (Recommended size: max width, 32px and max
                        height 32px.)</h5>
                    <input name="favicon" class="form-control " type="file">
                    <div class="text-center border p-2 mt-2 rounded-none">
                        <img src="{{ asset('storage/' . $settings->favicon) }}" alt="" class="w-25 img-fluid">
                    </div>
                </div>
            </div>
            <div class="mt-3 form-row">
                <div class="col-12">
                    <input type="submit" class="px-5 btn btn-primary btn-lg" value="Update">
                </div>

            </div>

        </form>
    </div>
</div>
