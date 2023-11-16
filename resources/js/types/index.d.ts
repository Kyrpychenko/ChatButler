export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>
> = T & {
    auth: {
        user: User;
    };
};

export type Message = {
    id: number;
    text: string;
    chat: Chat;
    type: "user" | "system" | "assistant";
    sent: Date;
};

export type Chat = {
    id: number;
    chat_room: ChatRoom;
    guest: Guest;
};

export type Guest = {
    id: number;
};

export type ChatRoom = {
    id: number;
    title: string;
    accessCode: string;
};
