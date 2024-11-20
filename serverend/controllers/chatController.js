import expressAsyncHandler from "express-async-handler";

var STATIC_CHANNELS = [
    {
        name: 'Global chat',
        participants: 0,
        id: 4,
        sockets: [],
        messages: [
            { id: 1, text: 'hii', senderName: 'User1' },
            { id: 2, text: 'hello', senderName: 'User2' }
        ]
    },
    {
        name: 'Funny',
        participants: 0,
        id: 5,
        sockets: [],
        messages: [
            { id: 3, text: 'hii123', senderName: 'User3' },
            { id: 4, text: 'hello123', senderName: 'User4' }
        ]
    },
    // Example of one-to-one chat channels
    {
        name: 'Chat with User5',
        participants: 2,
        id: 6,
        type: 'one-to-one',
        participants: ['User4', 'User5'],
        sockets: [], // Ensure sockets is defined
        messages: [
            { id: 5, text: 'Hello User5!', senderName: 'User4' },
            { id: 6, text: 'Hi User4!', senderName: 'User5' }
        ]
    },
    {
        name: 'Chat with User6',
        participants: 2,
        id: 7,
        type: 'one-to-one',
        participants: ['User4', 'User6'],
        sockets: [], // Ensure sockets is defined
        messages: [
            { id: 7, text: 'Hey User6!', senderName: 'User4' },
            { id: 8, text: 'Hello User4!', senderName: 'User6' }
        ]
    }
];

// Export a function that initializes the socket connection
export const initSocket = (io) => {
    io.on('connection', (socket) => {
        console.log('New client connected');

        // Emit a welcome message to the client
        socket.emit('connection', null);

        // Handle channel join
        socket.on('channel-join', (id) => {
            console.log('Channel join - Online', id);

            STATIC_CHANNELS.forEach((c) => {
                if (c.id === id) {
                    if (!c.sockets.includes(socket.id)) {
                        c.sockets.push(socket.id);
                        c.participants++;
                        io.emit('channel', c);
                        socket.emit('channel-messages', c.messages); // Send existing messages to the client
                    }
                } else {
                    if (c.sockets) { // Check if sockets is defined
                        const index = c.sockets.indexOf(socket.id);
                        if (index !== -1) {
                            c.sockets.splice(index, 1);
                            c.participants--;
                            io.emit('channel', c);
                        }
                    }
                }
            });
        });

        // Handle new message
        socket.on('message', (message) => {
            STATIC_CHANNELS.forEach((c) => {
                if (c.id === message.channel_id) {
                    if (c.messages) { // Check if messages is defined
                        c.messages.push(message);
                        io.emit('message', message); // Broadcast the message
                    }
                }
            });
        });

        // Handle typing event
        socket.on('typing', ({ channel_id, username }) => {
            socket.broadcast.to(channel_id).emit('typing', { username }); // Notify other clients in the channel
        });

        // Handle client disconnection
        socket.on('disconnect', () => {
            console.log("Client disconnected");

            STATIC_CHANNELS.forEach((c) => {
                if (c.sockets) { // Check if sockets is defined
                    const index = c.sockets.indexOf(socket.id);
                    if (index !== -1) {
                        c.sockets.splice(index, 1);
                        c.participants--;
                        io.emit('channel', c);
                    }
                }
            });
        });
    });
};

// An Express route handler that responds with channel data
export const open = expressAsyncHandler(async (req, res) => {
    res.status(200).json({
        channels: STATIC_CHANNELS
    });
});
