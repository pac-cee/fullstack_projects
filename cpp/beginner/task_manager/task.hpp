#ifndef TASK_HPP
#define TASK_HPP

#include <string>
#include <chrono>
#include <memory>

// Forward declaration
class User;

/**
 * @class Task
 * @brief Represents a task in the system
 * 
 * Demonstrates:
 * - Class design
 * - Encapsulation
 * - Date/Time handling
 * - Smart pointers
 * - Enums
 */
class Task {
public:
    // Task priority levels
    enum class Priority {
        LOW,
        MEDIUM,
        HIGH,
        URGENT
    };

    // Task status
    enum class Status {
        TODO,
        IN_PROGRESS,
        COMPLETED,
        CANCELLED
    };

private:
    int id;                     // Unique task identifier
    std::string title;          // Task title
    std::string description;    // Task description
    Priority priority;          // Task priority
    Status status;             // Current status
    std::chrono::system_clock::time_point dueDate;  // Due date
    std::chrono::system_clock::time_point created;  // Creation date
    std::weak_ptr<User> assignee;  // Assigned user (weak pointer to avoid circular reference)

public:
    // Constructor
    Task(const std::string& title, const std::string& description, Priority priority);

    // Getters
    int getId() const { return id; }
    const std::string& getTitle() const { return title; }
    const std::string& getDescription() const { return description; }
    Priority getPriority() const { return priority; }
    Status getStatus() const { return status; }
    std::chrono::system_clock::time_point getDueDate() const { return dueDate; }
    std::weak_ptr<User> getAssignee() const { return assignee; }

    // Setters
    void setTitle(const std::string& newTitle) { title = newTitle; }
    void setDescription(const std::string& newDesc) { description = newDesc; }
    void setPriority(Priority newPriority) { priority = newPriority; }
    void setStatus(Status newStatus) { status = newStatus; }
    void setDueDate(const std::chrono::system_clock::time_point& date) { dueDate = date; }
    void setAssignee(const std::shared_ptr<User>& user) { assignee = user; }

    // Utility methods
    bool isOverdue() const;
    std::string getPriorityString() const;
    std::string getStatusString() const;
    std::string getFormattedDueDate() const;
    std::string getFormattedCreationDate() const;

    // Serialization
    std::string serialize() const;
    static Task deserialize(const std::string& data);
};

#endif // TASK_HPP 