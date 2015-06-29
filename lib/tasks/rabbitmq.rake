# config/Rakefile
namespace :rabbitmq do
  desc "Setup routing"
  task :setup do
    require "bunny"

    conn = Bunny.new
    conn.start

    ch = conn.create_channel

    # get or create exchange
    x = ch.fanout("profmetrics.surveylinks")

    # get or create queue (note the durable setting)
    queue = ch.queue("dashboard.surveylinks", durable: true)

    # bind queue to exchange
    queue.bind("profmetrics.surveylinks")

    delivery_info, properties, payload = queue.pop

    puts "This is the message: " + payload + "\n\n"

    conn.close
  end
end



