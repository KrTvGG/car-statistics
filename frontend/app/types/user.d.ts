export {}

declare global {

    interface IUser {
        id: number,
        isSuperuser: bolean,
        isStaff: bolean,
        isActive: bolean,
        email: string,
    }
    
}