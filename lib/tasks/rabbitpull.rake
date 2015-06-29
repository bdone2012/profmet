namespace :rabbitpull do

   desc "Pull"
  task :pull do

    conn = Bunny.new
    conn.start

    ch = conn.create_channel

    # get or create queue (note the durable setting)
    queue = ch.queue("dashboard.surveylinks", durable: true)

  delivery_info, properties, payload = queue.pop

  puts "This is the message: " + payload + "\n\n"

  conn.close

end
end
