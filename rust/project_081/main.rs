use plotters::prelude::*;

fn main() {
    let root = BitMapBackend::new("plot.png", (640, 480)).into_drawing_area();
    root.fill(&WHITE).unwrap();
    let mut chart = ChartBuilder::on(&root)
        .caption("Line Plot", ("sans-serif", 40))
        .margin(20)
        .x_label_area_size(30)
        .y_label_area_size(30)
        .build_cartesian_2d(0..10, 0..10)
        .unwrap();
    chart.configure_mesh().draw().unwrap();
    chart.draw_series(LineSeries::new((0..10).map(|x| (x, x)), &RED)).unwrap();
    println!("Saved plot.png");
}
