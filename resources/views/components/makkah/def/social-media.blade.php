@if($type == 'footer' or $type == 'header')
  <div class="{{$cssStyle}}">
    <ul>
      @if(!empty($webConfig->social['facebook']))
        <li><a href="{{$webConfig->social['facebook']}}" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
      @endif

      @if(!empty($webConfig->social['instagram']))
        <li><a href="{{$webConfig->social['instagram']}}" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a></li>
      @endif


      @if(!empty($webConfig->social['twitter']))
        <li><a href="{{$webConfig->social['twitter']}}" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a></li>
      @endif

      @if(!empty($webConfig->social['linkedin']))
        <li><a href="{{$webConfig->social['linkedin']}}" target="_blank" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
      @endif

      @if(!empty($webConfig->social['youtube']))
        <li><a href="{{$webConfig->social['youtube']}}" target="_blank" title="Youtube"><i class="fab fa-youtube"></i></a></li>
      @endif


    </ul>
  </div>
@endif
