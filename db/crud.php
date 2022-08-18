<?php
    class crud{
        private $db;
        function __construct($conn){
            $this->db = $conn;  
        }

        public function insertAttendees($fname, $lname, $dob, $email,$contact,$specialty,$destination){
            try {
                // define sql statement to be executed
                $sql = "INSERT INTO attendee (firstname,lastname,dateofbirth,emailaddress,contactnumber,specialty_id,avatar_path) VALUES (:fname,:lname,:dob,:email,:contact,:specialty,:destination)";
                //prepare the sql statement for execution
                $stmt = $this->db->prepare($sql);
                //bind the values to the parameters
                $stmt->bindValue(':fname', $fname);
                $stmt->bindValue(':lname', $lname);
                $stmt->bindValue(':dob', $dob);
                $stmt->bindValue(':email', $email);
                $stmt->bindValue(':contact', $contact);
                $stmt->bindValue(':specialty', $specialty);
                $stmt->bindValue(':destination', $destination);
                //execute the sql statement
                $stmt->execute();
                
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
        public function editAttendee($id,$fname, $lname, $dob, $email,$contact,$specialty)
        {
            try {
                // define sql statement to be executed
                $sql = "UPDATE attendee SET firstname = :fname, lastname = :lname, dateofbirth = :dob, emailaddress = :email, contactnumber = :contact, specialty_id = :specialty WHERE attendee_id = :id";
                //prepare the sql statement for execution
                $stmt = $this->db->prepare($sql);
                //bind the values to the parameters
                $stmt->bindValue(':id', $id);
                $stmt->bindValue(':fname', $fname);
                $stmt->bindValue(':lname', $lname);
                $stmt->bindValue(':dob', $dob);
                $stmt->bindValue(':email', $email);
                $stmt->bindValue(':contact', $contact);
                $stmt->bindValue(':specialty', $specialty);
                //execute the sql statement
                $stmt->execute();
                
                return true;
            }
            catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
        public function getAttendees(){
            try {
                $sql = "SELECT * FROM attendee inner join specialties on attendee.specialty_id = specialties.specialty_id ORDER BY attendee_id";
                $result = $this->db->query($sql);
                return $result;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
        public function getAttendeeDetails($id){
            try {
                $sql = "SELECT * FROM attendee WHERE attendee_id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $result = $stmt->fetch();
                return $result;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
        public function getSpecialties(){
            try {
                $sql = "SELECT * FROM specialties";
                $result = $this->db->query($sql);
                return $result;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
        public function deleteAttendee($id){
            try {
                $sql = "DELETE FROM attendee WHERE attendee_id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }   

?>