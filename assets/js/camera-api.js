/**
 * Camera API Helper
 * จัดการ API calls สำหรับ camera module
 */
const CameraAPI = {
    baseUrl: '../api/capture',

    /**
     * ดึงข้อมูล Patient
     * @param {string} cid - Case ID
     * @returns {Promise<Object>}
     */
    async getPatient(cid) {
        try {
            const response = await fetch(this.baseUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    event: 'get_patient',
                    cid: cid
                })
            });
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return await response.json();
        } catch (error) {
            console.error('Error fetching patient:', error);
            throw error;
        }
    },

    /**
     * ดึงข้อมูล Case
     * @param {string} cid - Case ID
     * @returns {Promise<Object>}
     */
    async getCase(cid) {
        try {
            const response = await fetch(this.baseUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    event: 'get_case',
                    cid: cid
                })
            });
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return await response.json();
        } catch (error) {
            console.error('Error fetching case:', error);
            throw error;
        }
    },

    /**
     * ดึงข้อมูล Scope List
     * @returns {Promise<Array>}
     */
    async getScopes() {
        try {
            const response = await fetch(this.baseUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    event: 'get_scopes'
                })
            });
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return await response.json();
        } catch (error) {
            console.error('Error fetching scopes:', error);
            throw error;
        }
    },

    /**
     * ดึงข้อมูล Users (Doctor/Nurse)
     * @param {string} type - User type (doctor, nurse, nurse_assistant)
     * @returns {Promise<Array>}
     */
    async getUsers(type) {
        try {
            const response = await fetch(this.baseUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    event: 'get_users',
                    type: type
                })
            });
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return await response.json();
        } catch (error) {
            console.error('Error fetching users:', error);
            throw error;
        }
    },

    /**
     * ดึงข้อมูล Room List
     * @returns {Promise<Array>}
     */
    async getRooms() {
        try {
            const response = await fetch(this.baseUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    event: 'get_rooms'
                })
            });
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return await response.json();
        } catch (error) {
            console.error('Error fetching rooms:', error);
            throw error;
        }
    },

    /**
     * ดึงข้อมูล Images
     * @param {string} cid - Case ID
     * @returns {Promise<Array>}
     */
    async getImages(cid) {
        try {
            const response = await fetch(this.baseUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    event: 'get_images',
                    cid: cid
                })
            });
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return await response.json();
        } catch (error) {
            console.error('Error fetching images:', error);
            throw error;
        }
    },

    /**
     * ดึงข้อมูล Config
     * @returns {Promise<Object>}
     */
    async getConfig() {
        try {
            const response = await fetch(this.baseUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    event: 'get_config'
                })
            });
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return await response.json();
        } catch (error) {
            console.error('Error fetching config:', error);
            throw error;
        }
    },

    /**
     * อัปเดต Case
     * @param {string} cid - Case ID
     * @param {string} key - Key to update
     * @param {*} value - Value to set
     * @returns {Promise<void>}
     */
    async caseUpdate(cid, key, value) {
        try {
            const response = await fetch(this.baseUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    event: 'case_update',
                    cid: cid,
                    key: key,
                    value: value
                })
            });
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return await response.json();
        } catch (error) {
            console.error('Error updating case:', error);
            throw error;
        }
    },

    /**
     * ตั้งค่า Doctor Name
     * @param {string} cid - Case ID
     * @param {string|number} doctorId - Doctor UID
     * @returns {Promise<string>} Doctor name
     */
    async setDoctorname(cid, doctorId) {
        try {
            const response = await fetch(this.baseUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    event: 'set_doctorname',
                    cid: cid,
                    key: 'doctorname',
                    value: doctorId
                })
            });
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return await response.text();
        } catch (error) {
            console.error('Error setting doctorname:', error);
            throw error;
        }
    },

    /**
     * อัปเดต Attendant
     * @param {string} cid - Case ID
     * @param {string|number} dataId - User ID
     * @returns {Promise<Array>} Updated user_in_case array
     */
    async attendantUpdate(cid, dataId) {
        try {
            const response = await fetch(this.baseUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    event: 'attendant_update',
                    cid: cid,
                    data_id: dataId
                })
            });
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return await response.json();
        } catch (error) {
            console.error('Error updating attendant:', error);
            throw error;
        }
    },

    /**
     * โหลด User in Case (HTML)
     * @param {string} cid - Case ID
     * @returns {Promise<string>} HTML string
     */
    async loadUserincase(cid) {
        try {
            const response = await fetch(this.baseUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    event: 'load_userincase',
                    cid: cid
                })
            });
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return await response.text();
        } catch (error) {
            console.error('Error loading userincase:', error);
            throw error;
        }
    },

    /**
     * Scope Tracking
     * @param {string|number} scopeId - Scope ID
     * @param {string|number} uid - User ID (optional)
     * @returns {Promise<void>}
     */
    async scopetracking(scopeId, uid = null) {
        try {
            const response = await fetch(this.baseUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    event: 'scopetracking',
                    val: scopeId,
                    uid: uid
                })
            });
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return await response.json();
        } catch (error) {
            console.error('Error tracking scope:', error);
            throw error;
        }
    },

    /**
     * กลับหน้า Home
     * @param {string} cid - Case ID
     * @param {string} hn - HN
     * @param {string} caseuniq - Case Unique ID
     * @returns {Promise<void>}
     */
    async back2home(cid, hn, caseuniq) {
        try {
            const response = await fetch(this.baseUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    event: 'back2home',
                    cid: cid,
                    hn: hn,
                    caseuniq: caseuniq
                })
            });
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return await response.json();
        } catch (error) {
            console.error('Error back2home:', error);
            throw error;
        }
    },

    /**
     * Delete User from Case
     * @param {string} cid - Case ID
     * @param {string|number} userId - User ID ที่ต้องการลบ
     * @returns {Promise<Array>} Updated user_in_case array
     */
    async deleteUserFromCase(cid, userId) {
        try {
            const response = await fetch(this.baseUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    event: 'delete_user_in_case',
                    cid: cid,
                    id: userId
                })
            });
            const data = await response.json();
            if (!response.ok) {
                const errorMessage = data.error || `HTTP error! status: ${response.status}`;
                throw new Error(errorMessage);
            }
            return data;
        } catch (error) {
            console.error('Error deleting user from case:', error);
            throw error;
        }
    },

    /**
     * ดึงข้อมูล Storage
     * @returns {Promise<Object>}
     */
    async getStorage() {
        try {
            const response = await fetch(this.baseUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    event: 'get_storage'
                })
            });
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return await response.json();
        } catch (error) {
            console.error('Error fetching storage:', error);
            throw error;
        }
    },

    /**
     * ดึงข้อมูล Procedures
     * @returns {Promise<Array>}
     */
    async getProcedures() {
        try {
            const response = await fetch(this.baseUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    event: 'get_procedures'
                })
            });
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return await response.json();
        } catch (error) {
            console.error('Error fetching procedures:', error);
            throw error;
        }
    },

    /**
     * ดึงข้อมูล Cases วันนี้
     * @param {string} cid - Case ID (ปัจจุบัน) เพื่อยกเว้นจากผลลัพธ์
     * @returns {Promise<Array>}
     */
    async getCaseToday(cid) {
        try {
            const response = await fetch(this.baseUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    event: 'get_case_today',
                    cid: cid
                })
            });
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return await response.json();
        } catch (error) {
            console.error('Error fetching case today:', error);
            throw error;
        }
    }
};

// สำหรับ backward compatibility กับ jQuery code ที่มีอยู่
// ยังคงใช้ $.post แต่ส่งไปที่ API endpoint ใหม่
if (typeof $ !== 'undefined') {
    // Override case_update function
    window.case_update = function(key, value) {
        const cid = document.querySelector('[data-cid]')?.dataset?.cid || '';
        CameraAPI.caseUpdate(cid, key, value).catch(console.error);
    };
}

async function casemonitor_operation(cid) {
    try {
        const response = await fetch(CameraAPI.baseUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify({
                event: 'casemonitor_operation',
                cid: cid
            })
        });
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return await response.json();
    } catch (error) {
        console.error('Error in casemonitor_operation:', error);
        throw error;
    }
}
