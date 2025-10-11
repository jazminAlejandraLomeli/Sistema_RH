  {{-- Segundo nombramiento --}}
  <div class="card shadow-sm animate__animated animate__fadeInDown">
      <div class="card-body">
          <h5 class="card-title text-center">Nombramiento secundario</h5>
          <div class="row pt-2">
              <div class="col-12 col-md-6 col-xl-6">

                  <x-icon-cont
                      icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 32 32"><path fill="none" stroke="#059669" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M30 8H2v18h28ZM20 8s0-4-4-4s-4 4-4 4M8 26V8m16 18V8"/></svg>'
                      label="Nombramiento" text="{{ $Trabajo->nombramientoPersona->nombre }}" id="S_nombra"
                      data-id_nombra="{{ $Trabajo->nombramiento }}" />

                  <x-icon-cont
                      icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 32 32"><path fill="#059669" d="M27 22.141V18a2 2 0 0 0-2-2h-8v-4h2a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-6a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2v4H7a2 2 0 0 0-2 2v4.142a4 4 0 1 0 2 0V18h8v4.142a4 4 0 1 0 2 0V18h8v4.141a4 4 0 1 0 2 0M13 4h6l.001 6H13ZM8 26a2 2 0 1 1-2-2a2 2 0 0 1 2 2m10 0a2 2 0 1 1-2-2a2.003 2.003 0 0 1 2 2m8 2a2 2 0 1 1 2-2a2 2 0 0 1-2 2"/></svg>'
                      label="Categoría" text="{{ $Trabajo->trabajoCategoria->nombre }}" id="cate_name2" />

                  <span id="id_cate" class="d-none">{{ $Trabajo->id_categoria }} </span>

                  @if ($Trabajo->distincionAdicional)
                      <x-icon-cont
                          icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="#059669" d="M1 3a2 2 0 0 1 2-2h6.5a2 2 0 0 1 2 2v6.5a2 2 0 0 1-2 2H7v4.063C7 16.355 7.644 17 8.438 17H12.5v-2.5a2 2 0 0 1 2-2H21a2 2 0 0 1 2 2V21a2 2 0 0 1-2 2h-6.5a2 2 0 0 1-2-2v-2.5H8.437A2.94 2.94 0 0 1 5.5 15.562V11.5H3a2 2 0 0 1-2-2Zm2-.5a.5.5 0 0 0-.5.5v6.5a.5.5 0 0 0 .5.5h6.5a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5ZM14.5 14a.5.5 0 0 0-.5.5V21a.5.5 0 0 0 .5.5H21a.5.5 0 0 0 .5-.5v-6.5a.5.5 0 0 0-.5-.5Z"/></svg>'
                          label="Distinción adicional" text="{{ $Trabajo->distincionAdicional->nombre }}"
                          id="P_dist" />
                  @else
                      <x-icon-cont
                          icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="#059669" d="M1 3a2 2 0 0 1 2-2h6.5a2 2 0 0 1 2 2v6.5a2 2 0 0 1-2 2H7v4.063C7 16.355 7.644 17 8.438 17H12.5v-2.5a2 2 0 0 1 2-2H21a2 2 0 0 1 2 2V21a2 2 0 0 1-2 2h-6.5a2 2 0 0 1-2-2v-2.5H8.437A2.94 2.94 0 0 1 5.5 15.562V11.5H3a2 2 0 0 1-2-2Zm2-.5a.5.5 0 0 0-.5.5v6.5a.5.5 0 0 0 .5.5h6.5a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5ZM14.5 14a.5.5 0 0 0-.5.5V21a.5.5 0 0 0 .5.5H21a.5.5 0 0 0 .5-.5v-6.5a.5.5 0 0 0-.5-.5Z"/></svg>'
                          label="Distinción adicional" text="{{ '--' }}" id="P_dist" />
                  @endif
                  <x-icon-cont
                      icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 1024 1024"><path fill="#059669" d="M512 512a192 192 0 1 0 0-384a192 192 0 0 0 0 384m0 64a256 256 0 1 1 0-512a256 256 0 0 1 0 512"/><path fill="#059669" d="M512 512a32 32 0 0 1 32 32v256a32 32 0 1 1-64 0V544a32 32 0 0 1 32-32"/><path fill="#059669" d="M384 649.088v64.96C269.76 732.352 192 771.904 192 800c0 37.696 139.904 96 320 96s320-58.304 320-96c0-28.16-77.76-67.648-192-85.952v-64.96C789.12 671.04 896 730.368 896 800c0 88.32-171.904 160-384 160s-384-71.68-384-160c0-69.696 106.88-128.96 256-150.912"/></svg>'
                      label="Área de adscripción" text="{{ $Trabajo->area_distincion ?? '--' }}" id="P_area" />
                  {{-- $Trabajo->id_estado --}}
                  @php
                      $color = '';
                      switch ($Trabajo->estado->nombre) {
                          case 'Inactivo':
                              $color = '#dc2626';
                              break;

                          case 'De licencia':
                              $color = '#0B5ED7';
                              break;
                          case 'Incapacidad':
                              $color = '#eab308';
                              break;

                          default:
                              $color = '#373CC4';
                              break;
                      }

                  @endphp

                  <x-icon-cont
                      icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="{{ $color }}" fill-rule="evenodd" d="M18.98 9.253a7.52 7.52 0 0 0-4.233-4.234a3 3 0 0 0-.534.868a6.52 6.52 0 0 1 3.9 3.9a3 3 0 0 0 .868-.534m-6.752-3.75L12 5.5a6.5 6.5 0 1 0 6.496 6.272q.516-.162.976-.425q.027.323.028.653a7.5 7.5 0 1 1-6.847-7.472a5 5 0 0 0-.425.976" clip-rule="evenodd"/><circle cx="17" cy="7" r="3" fill="{{ $color }}"/></svg>'
                      label="Estatus laboral" text="{{ $Trabajo->estado->nombre }}" id="Person_Status" />

                  @if ($Trabajo->nombramiento == 6 || $Trabajo->nombramiento == 4)
                      <div class="col-12">

                          <div class="row">
                              <p class="fw-semibold mb-2">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                      viewBox="0 0 24 24">
                                      <g fill="none" stroke="#ea580c" stroke-width="1.5">
                                          <path stroke-linecap="round"
                                              d="M5.143 14A7.8 7.8 0 0 1 4 9.919C4 5.545 7.582 2 12 2s8 3.545 8 7.919A7.8 7.8 0 0 1 18.857 14" />
                                          <path
                                              d="M7.383 17.098c-.092-.276-.138-.415-.133-.527a.6.6 0 0 1 .382-.53c.104-.041.25-.041.54-.041h7.656c.291 0 .436 0 .54.04a.6.6 0 0 1 .382.531c.005.112-.041.25-.133.527c-.17.511-.255.767-.386.974a2 2 0 0 1-1.2.869c-.238.059-.506.059-1.043.059h-3.976c-.537 0-.806 0-1.043-.06a2 2 0 0 1-1.2-.868c-.131-.207-.216-.463-.386-.974ZM15 19l-.13.647c-.14.707-.211 1.06-.37 1.34a2 2 0 0 1-1.113.912C13.082 22 12.72 22 12 22s-1.082 0-1.387-.1a2 2 0 0 1-1.113-.913c-.159-.28-.23-.633-.37-1.34L9 19" />
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 16v-5" />
                                      </g>
                                  </svg>
                                  Semblanza del profesor
                              </p>
                              <div class="col-12">
                                  <div class="semblanza shadow-sm p-4 bg-light rounded-3">
                                      {{ $Trabajo->semblanza ?? 'Sin dato ..' }}
                                  </div>
                              </div>

                          </div>
                      </div>
                  @endif










              </div>

              {{-- Contenedor del lado derecho  --}}

              <div class="col-12 col-md-6 col-xl-6">

                  <div class="row pt-2">
                      <div class="form-group col-6">
                          <x-icon-cont
                              icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="#059669" d="M9 9V7h9v2zm0 3v-2h9v2zm3 8H5zm0 2H6q-1.25 0-2.125-.875T3 19v-3h3V2h15v9.025q-.5-.05-1.012.038t-.988.312V4H8v12h6l-2 2H5v1q0 .425.288.713T6 20h6zm2 0v-3.075l5.525-5.5q.225-.225.5-.325t.55-.1q.3 0 .575.113t.5.337l.925.925q.2.225.313.5t.112.55t-.1.563t-.325.512l-5.5 5.5zm7.5-6.575l-.925-.925zm-6 5.075h.95l3.025-3.05l-.45-.475l-.475-.45l-3.05 3.025zm3.525-3.525l-.475-.45l.925.925z"/></svg>'
                              label="T. Contrato" text="{{ $Trabajo->tipo_contrato }} " id="P_contrato" />

                      </div>
                      <div class="form-group col-6">
                          @php
                              $fecha_termino = '';
                              if ($Trabajo->fecha_termino != null) {
                                  $fecha_termino = \Carbon\Carbon::parse($Trabajo->fecha_termino)
                                      ->locale('es')
                                      ->isoFormat('LL');
                              } else {
                                  $fecha_termino = '--';
                              }
                          @endphp

                          <x-icon-cont
                              icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 16 16"><path fill="#059669" d="M11.5 2A2.5 2.5 0 0 1 14 4.5v2.1a5.5 5.5 0 0 0-1-.393V6H3v5.5A1.5 1.5 0 0 0 4.5 13h1.707q.149.524.393 1H4.5A2.5 2.5 0 0 1 2 11.5v-7A2.5 2.5 0 0 1 4.5 2zm0 1h-7A1.5 1.5 0 0 0 3 4.5V5h10v-.5A1.5 1.5 0 0 0 11.5 3m4.5 8.5a4.5 4.5 0 1 1-9 0a4.5 4.5 0 0 1 9 0m-2.646-1.146a.5.5 0 0 0-.708-.708L11.5 10.793l-1.146-1.147a.5.5 0 0 0-.708.708l1.147 1.146l-1.147 1.146a.5.5 0 0 0 .708.708l1.146-1.147l1.146 1.147a.5.5 0 0 0 .708-.708L12.207 11.5z"/></svg>'
                              label="F. de termino" text="{{ $fecha_termino }}" id="f_termino" />

                          <span class="d-none" id="P_termino">{{ $Trabajo->fecha_termino }}</span>
                      </div>
                  </div>
                  <div class="row">
                      <div class="form-group col-6">
                          <x-icon-cont
                              icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><g fill="none" stroke="#059669" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" color="#059669"><path d="M11.007 21H9.605c-3.585 0-5.377 0-6.491-1.135S2 16.903 2 13.25s0-5.48 1.114-6.615S6.02 5.5 9.605 5.5h3.803c3.585 0 5.378 0 6.492 1.135c.857.873 1.054 2.156 1.1 4.365"/><path d="m18.85 18.85l-1.35-.9V15.7M13 17.5a4.5 4.5 0 1 0 9 0a4.5 4.5 0 0 0-9 0m3-12l-.1-.31c-.494-1.54-.742-2.31-1.331-2.75C13.979 2 13.197 2 11.632 2h-.264c-1.565 0-2.348 0-2.937.44c-.59.44-.837 1.21-1.332 2.75L7 5.5"/></g></svg>'
                              label="H. de trabajo" text="{{ $Trabajo->horas_trabajo ?? '--' }}" id="P_horas" />

                      </div>
                      <div class="form-group col-6">
                          <x-icon-cont
                              icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 16 16"><path fill="none" stroke="#059669" d="M14.5 8A6.5 6.5 0 1 0 8 14.5M8 4v4H4m7.5 1.5v2m3 0a3 3 0 1 1-6 0a3 3 0 0 1 6 0Zm-3 1.25h.005v.005H11.5zm.25 0a.25.25 0 1 1-.5 0a.25.25 0 0 1 .5 0Z"/></svg>'
                              label="Turno" text="{{ $Trabajo->turno ?? '--' }}" id="P_turno" />
                      </div>
                  </div>

                  <div class="row">
                      @php
                          $horarios = explode(',', $Trabajo->horario_oficial);
                          $half = ceil(count($horarios) / 2);
                          $firstHalf = array_slice($horarios, 0, $half);
                          $secondHalf = array_slice($horarios, $half);
                      @endphp

                      <div class="form-group pt-2 col-12">
                          <p class="fw-semibold mb-2">
                              <svg class="ps-2" xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                  viewBox="0 0 24 24">
                                  <g fill="none" stroke="#0B5ED7" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2">
                                      <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0-18 0" />
                                      <path d="M12 7v5l3 3" />
                                  </g>
                              </svg>
                              Horario Oficial
                          </p>
                          <div class="row">
                              @if (empty($secondHalf))
                                  <div class="col-md-12">
                                  @else
                                      <div class="col-md-6">
                              @endif

                              <ul class="list-group shadow-sm p-1 bg-light rounded-3 mb-2">
                                  @foreach ($firstHalf as $horario)
                                      <li
                                          class="list-group-item border-0 d-flex align-items-center gap-1 bg-transparent ">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                              viewBox="0 0 1024 1024">
                                              <path fill="#059669"
                                                  d="M512 64a448 448 0 1 1 0 896a448 448 0 0 1 0-896m-55.808 536.384l-99.52-99.584a38.4 38.4 0 1 0-54.336 54.336l126.72 126.72a38.27 38.27 0 0 0 54.336 0l262.4-262.464a38.4 38.4 0 1 0-54.272-54.336z" />
                                          </svg>
                                          <span class="fw-normal">{{ trim($horario) }}</span>
                                      </li>
                                  @endforeach
                              </ul>
                          </div>

                          @if (!empty($secondHalf))
                              <div class="col-md-6">
                                  <ul class="list-group shadow-sm p-1 bg-light rounded-3">
                                      @foreach ($secondHalf as $horario)
                                          <li
                                              class="list-group-item border-0 d-flex align-items-center gap-2 bg-transparent">
                                              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                  viewBox="0 0 1024 1024">
                                                  <path fill="#059669"
                                                      d="M512 64a448 448 0 1 1 0 896a448 448 0 0 1 0-896m-55.808 536.384l-99.52-99.584a38.4 38.4 0 1 0-54.336 54.336l126.72 126.72a38.27 38.27 0 0 0 54.336 0l262.4-262.464a38.4 38.4 0 1 0-54.272-54.336z" />
                                              </svg>
                                              <span class="fw-normal">{{ trim($horario) }}</span>
                                          </li>
                                      @endforeach
                                  </ul>
                              </div>
                          @endif
                      </div>
                  </div>
              </div>


              <div class="row mt-1">
                  <div class="form-group pt-2 col-12">
                      <p class="fw-semibold mb-2">
                          <svg class="ps-2" xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                              viewBox="0 0 24 24">
                              <g fill="none" stroke="#0B5ED7" stroke-width="1.5">
                                  <path
                                      d="M15.59 17.74c-.629.422-2.277 1.282-1.273 2.358c.49.526 1.037.902 1.723.902h3.92c.686 0 1.233-.376 1.723-.902c1.004-1.076-.644-1.936-1.273-2.357a4.29 4.29 0 0 0-4.82 0ZM20 12.5a2 2 0 1 1-4 0a2 2 0 0 1 4 0Z" />
                                  <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M10 6h5m-5-3h8M7 9.5V14c0 .943 0 1.414-.293 1.707S5.943 16 5 16H4c-.943 0-1.414 0-1.707-.293S2 14.943 2 14v-2.5c0-.943 0-1.414.293-1.707S3.057 9.5 4 9.5zm0 0h5" />
                                  <path d="M6.5 5a2 2 0 1 1-4 0a2 2 0 0 1 4 0Z" />
                              </g>
                          </svg>
                          Departamentos a los que imparte clase
                      </p>

                      <div class="row">

                          @if (empty($Trabajo->departamento))
                              <ul class="list-group shadow-sm p-1 bg-light rounded-3 mb-2">
                                  @foreach ($Trabajo->departamento as $departamento)
                                      <li
                                          class="list-group-item border-0 d-flex align-items-center gap-1 bg-transparent ">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                              viewBox="0 0 24 24">
                                              <g fill="none" fill-rule="evenodd">
                                                  <path
                                                      d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                                                  <path fill="currentColor"
                                                      d="M15 6a3 3 0 0 1-2 2.83V11h3a3 3 0 0 1 3 3v1.17a3.001 3.001 0 1 1-2 0V14a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v1.17a3.001 3.001 0 1 1-2 0V14a3 3 0 0 1 3-3h3V8.83A3.001 3.001 0 1 1 15 6m-3-1a1 1 0 1 0 0 2a1 1 0 0 0 0-2M6 17a1 1 0 1 0 0 2a1 1 0 0 0 0-2m12 0a1 1 0 1 0 0 2a1 1 0 0 0 0-2" />
                                              </g>
                                          </svg>
                                          <span class="fw-normal">{{ $departamento->nombre }}</span>
                                      </li>
                                  @endforeach
                              </ul>
                          @else
                              <div class="">
                                  @if ($Trabajo->departamento->isNotEmpty())
                                      <ul class="list-group shadow-sm p-1 bg-light rounded-3 mb-2">
                                          @foreach ($Trabajo->departamento as $departamento)
                                              <li
                                                  class="list-group-item border-0 d-flex align-items-center gap-1 bg-transparent ">
                                                  <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                      height="20" viewBox="0 0 24 24">
                                                      <g fill="none" fill-rule="evenodd">
                                                          <path
                                                              d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                                                          <path fill="currentColor"
                                                              d="M15 6a3 3 0 0 1-2 2.83V11h3a3 3 0 0 1 3 3v1.17a3.001 3.001 0 1 1-2 0V14a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v1.17a3.001 3.001 0 1 1-2 0V14a3 3 0 0 1 3-3h3V8.83A3.001 3.001 0 1 1 15 6m-3-1a1 1 0 1 0 0 2a1 1 0 0 0 0-2M6 17a1 1 0 1 0 0 2a1 1 0 0 0 0-2m12 0a1 1 0 1 0 0 2a1 1 0 0 0 0-2" />
                                                      </g>
                                                  </svg>
                                                  <span class="fw-normal">{{ $departamento->nombre }}</span>
                                              </li>
                                          @endforeach
                                      </ul>
                                  @else
                                      <div class="bg-light rounded-3">

                                          <div class="d-flex justify-content-center align-items-center">
                                              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                  viewBox="0 0 24 24">
                                                  <path fill="#059669"
                                                      d="M2 11.75a.75.75 0 0 1 .75-.75h18.5a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1-.75-.75" />
                                              </svg>

                                              <p class="fw-normal fs-5 text-center p-3 mt-3">Sin departamentos</p>

                                              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                  viewBox="0 0 24 24">
                                                  <path fill="#059669"
                                                      d="M2 11.75a.75.75 0 0 1 .75-.75h18.5a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1-.75-.75" />
                                              </svg>
                                          </div>

                                      </div>
                                  @endif
                              </div>
                          @endif
                      </div>

                  </div>
              </div>


          </div>


          <!-- botones -->
          @role('Administrador')
              <div class="col-12 d-flex justify-content-end mt-3 gap-2">
                  <div>
                      <button class="btn fst-normal px-4 animated-icon button-eliminar" id="BtnS"
                          data-worker="{{ $id }}" data-id="{{ $Trabajo->id }}" 
                          data-boton-presionado="BtnS" data-bs-toggle="tooltip"
                          data-bs-html="true" data-bs-title="Eliminar el nombramiento <b>secundario</b> de la persona">
                          <i class="fa-solid fa-trash"></i> Eliminar
                      </button>
                  </div>
                  <div>

                      <button class="btn fst-normal px-4 animated-icon button-cancel" id="Change"
                          data-id="{{ $id }}" data-bs-toggle="tooltip" data-bs-html="true"
                          data-bs-title="<b> Intercambiar </b> los nombramientos de la persona">
                          <i class="fa-solid fa-right-left"></i> Trabajo
                      </button>


                  </div>
                  <div>

                      <button id="botonEditarS" class="btn fst-normal px-4 animated-icon button-edit "
                          data-bs-toggle="modal" data-bs-target="#EditarSecunadario">
                          <i class="fa-solid fa-pen animated-icon px-1"></i> Editar
                      </button>

                      {{-- <button class="btn fst-normal px-4 animated-icon button-edit" id="botonEditarS" 
                          data-id="{{ $id }}" data-bs-toggle="tooltip" data-bs-html="true"
                          data-bs-title="<b>Actualizar</b> los datos del nombramiento"
                          data-bs-toggle="modal" data-bs-target="#EditarSecunadario">
                          <i class="fa-solid fa-pen animated-icon px-1"></i> Editar
                        </button> --}}


                      {{-- <x-tooltip title="<b>Actualizar</b> los datos del nombramiento" position="top"
                          class="btn fst-normal px-4 animated-icon button-edit" tag="button"
                          icon="fa-solid fa-pen animated-icon" id="botonEditarS" data-bs-toggle="modal"
                          data-bs-target="#EditarSecunadario">
                          Editar
                      </x-tooltip> --}}



                  </div>
              </div>
          @endrole
      </div>

  </div>
