@foreach($cities as $city)
    <option value="{{ $city->id }}" {{ ($city_id == $city->id) ? "selected" : "" }} >{{ $city->name }}</option>
@endforeach

