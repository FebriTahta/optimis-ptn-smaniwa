<div class="filters_full element_to_stick">
    <div class="container clearfix">
        <div class="sort_select">
            <select name="sort" id="sort">
                <option value="popularity" selected="selected">Choose PTN</option>
                @foreach ($univ as $item)
                    <option value="{{ $item->id }}">{{ $item->univ_name }}</option>
                @endforeach
            </select>
        </div>
        <a href="#collapseFilters" data-toggle="collapse" class="btn_filters"><i class="icon_adjust-vert"></i><span>Filters</span></a>
        <div class="search_bar_list">
            <input type="text" class="form-control" placeholder="Search again...">
        </div>
        <a class="btn_search_mobile btn_filters" data-toggle="collapse" href="#collapseSearch"><i class="icon_search"></i></a>
    </div>
    <div class="collapse filters_2" id="collapseFilters">
    <div class="container margin_detail">
        <div class="row">
            <div class="col-md-4">
                <div class="filter_type">
                    <h6>Jurusan</h6>
                    <ul>
                        @foreach ($jurusan_ as $item)
                        <li>
                            <label class="container_check">{{ $item->jurusan_name }}
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                 <div class="filter_type">
                    <h6>Jurusan</h6>
                    <ul>
                        @foreach ($jurusan_2 as $item2)
                        <li>
                            <label class="container_check">{{ $item2->jurusan_name }}
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                        </li> 
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="filter_type">
                    <h6>Note :</h6>
                    <div class="range_input">Pilih salah satu atau beberapa data jurusan yang tersedia berikut ini</div>
                    <a href="#" class="btn_1">Pilih</a>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
</div>
<!-- /filters -->
<div class="collapse" id="collapseSearch">
    <div class="search_bar_list">
        <input type="text" class="form-control" placeholder="Search again...">
    </div>
</div>
<!-- /collapseSearch -->
</div>
<!-- /filters_full -->