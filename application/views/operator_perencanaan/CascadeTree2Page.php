<span style="position: fixed;z-index:99999;right: 0px;bottom: 0px;background: #f1f1f1;padding: 4px 12px;margin: 4px;box-shadow: 1px 1px 2px 0px #000000cc;border-bottom: dashed;">
  <span class='rpjmd-text'>Sasaran RPJMD</span> | <span class='kegiatan-text'>Kegiatan PD</span>
</span>
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="ibox ssection-container">
    <div class="ibox-content">
      <form class="form-inline" id="showForm" onsubmit="return false;">
        <select class="form-control mr-sm-2" name="id_opd" id="id_opd" <?=!$this->session->userdata("admin_opd") ? "readonly='readonly'" : ''?> style="width:400px">
            <option value>-- Pilih OPD --</option>
        </select>
        <select class="form-control mr-sm-2" name="tahun" id="tahun" required="required">
          <option value>-- Pilih Tahun --</option>
          <option value='2020'>2020</option>
          <option value='2019'>2019</option>
          <option value='2018'>2018</option>
          <option value='2017'>2017</option>
        </select>  
        <button type="submit" class="btn btn-success my-1 mr-sm-2" id="show_btn" data-loading-text="Loading..." disabled><i class="fal fa-eye"></i> Tampilkan</button>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-content">
          <div class="viz-main">
            <div class="debug-container">
              <h3 class="svg-metric"></h3>
              <h3 class="node-metric"></h3>
            </div>
            <div id="box"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  .debug-container {
    display: none;
  }
  .viz-main {
    padding: 10px 20px 10px 20px;
    box-sizing: border-box;
    width: 100%;
    height: 100%;
  }

  .svg {
    pointer-events: all;
    color: #FFFFC2;
  }

  .node circle {
    cursor: pointer;
    fill: #fff;
  }

  .node text {
    font-size: 12px;
  }

  path.link {
    fill: none;
    stroke: #ccc;
    stroke-width: 1.5px;
  }
</style>
<script type="text/javascript">
$(document).ready(function() {
  $('#cascade_result_2').addClass('active');
  $('#cascade_result_2 #tree').addClass('active');

  var FDataTable = $('#FDataTable').DataTable({
    'columnDefs': [],
    deferRender: true,
    searching: false,
    ordering: false,
    paging: false,
  });

  var SSection = {
    'form': $('#showForm'),
    'tahun': $('#tahun'),
    'opd': $('#id_opd'),
    'show_btn' : $('#show_btn')
  }

  SSection.form.on('submit', function(e){
    e.preventDefault();
    getCascadeIndikator();
  });

  $.when(getAllOPD()).done(() => {
    SSection.show_btn.prop('disabled', false);
  })

  function getAllOPD(){
    return $.ajax({
      url: "<?php echo site_url('SharedController/getAllOPD')?>",
      data : {},
      type: 'POST',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataAllOPD = json['data'];
        renderOPD(dataAllOPD, json['curr']);
      },
      error: function(e) {}
    });
  }

  function renderOPD(data, curr){
    SSection.opd.empty();
    SSection.opd.append($('<option>', { value: "", text: "-- SEMUA OPD --"}));
    Object.values(data).forEach((e) => {
      SSection.opd.append($('<option>', {
        value: e['id_opd'],
        text: e['nama_opd'],
      }));
    });

    SSection.opd.val(curr);
  }


  function getCascadeIndikator(){
    buttonLoading(SSection.show_btn);
    $.ajax({
      url: `<?php echo site_url('OPPerencanaanController/getCascadeRPJMD2/')?>`,
      data : SSection.form.serialize(),
      type: 'GET',
      success: function (data){
        buttonIdle(SSection.show_btn);
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataCascadeIndikator = json['data'];
        renderCascadeIndikator(dataCascadeIndikator);
      },
      error: function(e) {}
    });
  }

  function renderCascadeIndikator(data){
    if(data == null || typeof data != "object" || data['root'] == undefined){
      console.log("CascadeIndikator::UNKNOWN DATA");
      return;
    }
    var i = 0;
    
    var renderData = {};
    var RPJMD = []
    
    Object.values(data['root']['sasaran_rpjmd']).forEach((rpjmd) => {
      var indikatorRPJMD = [];
      Object.values(rpjmd['indikator_sasaran_rpjmd']).forEach((isr) => {
        var kegiatan = []
        Object.values(isr['kegiatan_renja']).forEach((kr) => {
          var indikatorKegiatan = []
          Object.values(kr['indikator_kegiatan_renja']).forEach((ikr) => {
            indikatorKegiatan.push({'type': 'indikator-kegiatan', 'name' : `${ikr['id_indikator_kegiatan_renja']} :: ${ikr['nama_indikator_kegiatan_renja']}`})
          });
          kegiatan.push({'type': 'kegiatan', 'name': `${kr['id_kegiatan_renja']} :: ${kr['nama_kegiatan_renja']}`, 'belanja': kr['total_belanja_kegiatan'], 'children': indikatorKegiatan});
        });
        indikatorRPJMD.push({'type': 'indikator-rpjmd', 'name': `${isr['id_indikator_sasaran_rpjmd']} :: ${isr['nama_indikator_sasaran_rpjmd']}`, 'belanja': isr['total_belanja_indikator_rpjmd'], 'children': kegiatan});
      });
      RPJMD.push({'type': 'rpjmd', 'name': `${rpjmd['id_sasaran_rpjmd']} :: ${rpjmd['nama_sasaran_rpjmd']}`, 'belanja': rpjmd['total_belanja_rpjmd'], 'children': indikatorRPJMD});
    });
    renderData = {'type': 'root', 'name': data['root']['nama_root'], 'belanja': data['root']['total_belanja'], 'children': RPJMD}
      
    loadData(renderData);
  }

  
  // center the letter-containers in the tag-letters container
  //function centerTagLetters() {
  var realWidth = $('.viz-main').width();
  var realHeight = realWidth * (7.6 / 16);
    
  var m = [0, 0, 0, 0],
  w = realWidth - m[0] - m[0],
  h = realHeight - m[0] - m[2],
  i = 0,
  root;

  var tree = d3.layout.tree()
  .sort(function comparator(a, b) {
        return +b.size - +a.size;
    })
  .size([w, h])
  
  var diagonal = d3.svg.diagonal()
  .projection(function(d) {
    return [d.x, d.y];
  });

  var vis = d3.select("#box").append("svg:svg")
  .attr("class", "svg_container")
  .attr("width", w)
  .attr("height", h)
  .style("overflow", "scroll")
  .style("background-color", " #F0F8FF")
  .style("border-style", "solid")
  .style("border-color", " #EBF4FA")

  .append("svg:g")
  .attr("class", "drawarea")
  .append("svg:g")
  .attr("transform", "translate(" + m[3] + "," + m[0] + ")");


  function loadData(json) {
    root = json;
    d3.select("#processName").html(root.text);
    root.x0 = h / 2;
    root.y0 = 0;

    update(root);
  }

  function update(source) {
    var duration = d3.event && d3.event.altKey ? 5000 : 500;

    // Compute the new tree layout.
    var nodes = tree.nodes(root).reverse();
    //console.warn(nodes)

    // Normalize for fixed-depth.
    nodes.forEach(function(d) {
      d.y = d.depth * 125;
    });

    // Update the nodes…
    var node = vis.selectAll("g.node")
      .data(nodes, function(d) {
        return d.id || (d.id = ++i);
      });

    // Enter any new nodes at the parent's previous position.
    var nodeEnter = node.enter().append("svg:g")
      .attr("class", "node")
      .attr("transform", function(d) {
        return "translate(" + source.y0 + "," + source.x0 + ")";
      })
      .on("click", function(d) {
        toggle(d);
        update(d);
      });

    nodeEnter.append("svg:circle")
      .attr("r", function(d) {
        return 25;
      })
      .attr("class", function(d) {
        return d.type + "-circle";
      });

    nodeEnter.append("svg:text")
      .append("tspan")
      .text(function(d) { return d.name; })
      .attr("y", function(d) { return d.belanja !== undefined ? 35 : 18; } )
      .attr("dy", ".35em")
      .attr("text-anchor", 'middle')
      .attr("title", function(d) { return d.name; })
      .style("fill-opacity", 1)
      .call(wrap, 250);

      
    nodeEnter.append("svg:text")
      .append("tspan")
      .text(function(d) { return d.belanja !== undefined ? '(Belanja: ' + (d.belanja != null ? `Rp${convertToRupiah(d.belanja)}` : 'Tidak ditemukan') + ')' : ''; })
      .attr("y", 18)
      .attr("dy", ".35em")
      .attr("text-anchor", 'middle')
      .attr("title", function(d) { return d.belanja !== undefined ? '(Belanja: ' + (d.belanja != null ? `Rp${convertToRupiah(d.belanja)}` : 'Tidak ditemukan') + ')' : ''; })
      .style("fill-opacity", 1)
      .call(wrap, 250);

    // Transition nodes to their new position.
    var nodeUpdate = node.transition()
      .duration(duration)
      .attr("transform", function(d) {
        return "translate(" + d.x + "," + d.y + ")";
      });

    nodeUpdate.select("circle")
      .attr("r", function(d) {
        return 10;
      })
      .attr("class", function(d) {
        return d.type + "-circle";
      })

    nodeUpdate.select("text")
      .style("fill-opacity", 1);

    // Transition exiting nodes to the parent's new position.
    var nodeExit = node.exit().transition()
      .duration(duration)
      .attr("transform", function(d) {
        return "translate(" + source.y + "," + source.x + ")";
      })
      .remove();

    nodeExit.select("circle")
      .attr("r", function(d) {
        return 10;
        //return Math.sqrt((d.part_cc_p * 1)) + 4;
      });

    nodeExit.select("text")
      .style("fill-opacity", 1e-6);

    // Update the links…
    var link = vis.selectAll("path.link")
      .data(tree.links(nodes), function(d) {
        return d.target.id;
      });

    // Enter any new links at the parent's previous position.
    link.enter().insert("svg:path", "g")
      .attr("class", "link")
      .attr("d", function(d) {
        var o = {
          x: source.x0,
          y: source.y0
        };
        return diagonal({
          source: o,
          target: o
        });
      })
      .transition()
      .duration(duration)
      .attr("d", diagonal);

    // Transition links to their new position.
    link.transition()
      .duration(duration)
      .attr("d", diagonal);

    // Transition exiting nodes to the parent's new position.
    link.exit().transition()
      .duration(duration)
      .attr("d", function(d) {
        var o = {
          x: source.x,
          y: source.y
        };
        return diagonal({
          source: o,
          target: o
        });
      })
      .remove();

    // Stash the old positions for transition.
    nodes.forEach(function(d) {
      d.x0 = d.x;
      d.y0 = d.y;
    });

    d3.select("svg")
      .call(d3.behavior.zoom()
        .scaleExtent([0.5, 5])
        .on("zoom", zoom));

  }

  function wrap(text, width) {
    text.each(function() {
      var text = d3.select(this),
          words = text.text().split(/\s+/).reverse(),
          word,
          line = [],
          lineNumber = 0,
          lineHeight = 1.1, // ems
          y = text.attr("y"),
          dy = parseFloat(text.attr("dy")),
          tspan = text.text(null).append("tspan").attr("x", 0).attr("y", y).attr("dy", dy + "em");
      while (word = words.pop()) {
        line.push(word);
        tspan.text(line.join(" "));
        if (tspan.node().getComputedTextLength() > width) {
          line.pop();
          tspan.text(line.join(" "));
          line = [word];
          tspan = text.append("tspan").attr("x", 0).attr("y", y).attr("dy", ++lineNumber * lineHeight + dy + "em").text(word);
        }
      }
    });
  }

  // Toggle children.
  function toggle(d) {
    $(".node-metric").html("User Clicked Node > " + d.name);
    if (d.children) {
      d._children = d.children;
      d.children = null;
    } else {
      d.children = d._children;
      d._children = null;
    }
  }

  function zoom() {
    var scale = d3.event.scale,
      translation = d3.event.translate,
      tbound = -h * scale,
      bbound = h * scale,
      lbound = (-w + m[1]) * scale,
      rbound = (w - m[3]) * scale;
    // limit translation to thresholds
    translation = [
      Math.max(Math.min(translation[0], rbound), lbound),
      Math.max(Math.min(translation[1], bbound), tbound)
    ];
    d3.select(".drawarea")
      .attr("transform", "translate(" + translation + ")" +
        " scale(" + scale + ")");
  }
  
});
</script>
